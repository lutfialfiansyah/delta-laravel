<?php

namespace App\Http\Controllers;

use App\Branch;
use App\COA\CoaList;
use App\Customer;
use App\CustomerGroup;
use App\Helpers\MegaTrend;
use App\Models\COA\CoaControl;
use App\Product;
use App\ProductBrand;
use App\ProductCategory;
use App\Unit;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function index(){
        $symbol = DB::table('currency')->where('id',1)->get();
        Session::put(['user_id'=>Auth::user()]);
        Session::put([
            'currency_id'=>'1',
            'branch_id'=>1,
            'symbol'=>$symbol[0]->symbol
        ]);
        return view('modules.dashboard.dashboard');
    }
    public function product(){
        $products = Product::all();
        return view('modules.dashboard.product_dashboard',compact('products'));
    }
    public function brand(){
        $brands = ProductBrand::all();
        $code = MegaTrend::getLastCode('PB','product_brand','code');
        return view('modules.dashboard.productbrand_dashboard',compact('brands','code'));
    }
    public function category()
    {
        $code = MegaTrend::getLastCode('PC','product_category','code');
        return view('modules.dashboard.category_dashboard', compact('code'));
    }
    public function subCategory()
    {
        $category = ProductCategory::all();
        $code = MegaTrend::getLastCode('PS', 'product_sub_category', 'code');
        return view('modules.dashboard.sub_category_dashboard', compact('category','code'));
    }
    public function stockBeginning()
    {
        $products = Product::all();
        $branch = Branch::all();
        $unit = Unit::all();
        return view('modules.dashboard.stockBeginning_dashboard',compact('products','branch','unit'));
    }
    public function unit(){
        return view('modules.dashboard.unit_dashboard');
    }
    public function unitconversion(){
        return view('modules.dashboard.unitconversion_dashboard');
    }
    public function productType(){
        return view('modules.dashboard.productType_dashboard');
    }
    public function productGroup(){
        $code = MegaTrend::getLastCode('PG','product_group','code');
        return view('modules.dashboard.productGroup_dashboard',compact('code'));
    }
    public function customerGroup(){
        return view('modules.dashboard.customerGroup_dashboard');
    }
    public function customer(){
        return view('modules.dashboard.customer_dashboard');
    }
    public function price(){
        $products = Product::all();
        $customers = CustomerGroup::all();
        $branch = DB::table('branch')->select('id','description')->get();
        return view('modules.dashboard.price_dashboard',compact('branch','products','customers'));
    }
    public function delivery(){
        return view('modules.dashboard.shipping_dashboard');
    }
    public function purchaseOrder(){
        return view('modules.dashboard.purchaseOrder_dashboard');
    }
    public function purchase(){
        return view('modules.dashboard.purchase_dashboard');
    }
    public function paymentTerm(){
        return view('modules.dashboard.paymentTerm_dashboard');
    }
    public function vendors(){
        return view('modules.dashboard.vendors_dashboard');
    }
    public function warehouse(){
        return view('modules.dashboard.warehouse_dashboard');
    }
    public function purchaseReturn(){
        return view('modules.dashboard.purchaseReturn_dashboard');
    }
    public function salesReturn(){
        return view('modules.dashboard.salesReturn_dashboard');
    }
    public function salesman(){
        return view('modules.dashboard.salesman_dashboard');
    }
    public function vendorGroup(){
        return view('modules.dashboard.vendorGroup_dashboard');
    }
    public function salesTransaction(){
        return view('modules.dashboard.salesTransaction_dashboard');
    }
    public function salesOrder(){
        return view('modules.dashboard.salesOrder_dashboard');
    }
    public function accountPayable(){
        $vendor = Vendor::all();
        return view('modules.dashboard.accountPayable_dashboard',compact('vendor'));
    }
    public function accountReceivable(){
        $customer = Customer::all();
        return view('modules.dashboard.accountReceiveable_dashboard',compact('customer'));
    }
    public function creditNoteType(){
        return view('modules.dashboard.creditNoteType_dashboard');
    }
    public function debitNoteType(){
        return view('modules.dashboard.debitNoteType_dashboard');
    }
    public function apPayment(){
        $vendor = Vendor::all();
        $bank = DB::table('coa_list as a')
            ->leftjoin('coa_list as b','a.coa_parent_id','=','b.id')
            ->whereIn('a.coa_parent_id',function($q){
                $q->select('id')->from('coa_list')->where('coa_parent_id',5);
            })
            ->select('a.name as bankname','a.id')
            ->get();
        return view('modules.dashboard.apPayment_dashboard',compact('vendor','bank'));
    }
    public function arPayment(){
        $bank = DB::table('coa_list as a')
            ->leftjoin('coa_list as b','a.coa_parent_id','=','b.id')
            ->whereIn('a.coa_parent_id',function($q){
                $q->select('id')->from('coa_list')->where('coa_parent_id',5);
            })
            ->select('a.name as bankname','a.id')
            ->get();
        $customer = Customer::all();
        return view('modules.dashboard.arPayment_dashboard',compact('customer','bank'));
    }
    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    public function coaList(){
        $type = DB::table('coa_type')->get();
        return view('modules.dashboard.coaList_dashboard',compact("type"));
    }
    public function coaPivotParent(){
        $coa_parent = CoaList::wherenull('coa_parent_id')->get();
        //print_r($coa_parent);
        return view('modules.dashboard.coaPivotParent_dashboard',compact('coa_parent'));
    }
    public function coaControl(){
        $coalist = \App\Models\COA\CoaList::all();
        return view('modules.dashboard.coaControl_dashboard',compact('coalist'));
    }
    public function cnTransaction(){
        $customer = Customer::all();
        $code = MegaTrend::getLastCode('CT','cn_transaction','cn_transaction_no');
        return view('modules.dashboard.cnTransaction_dashboard',compact('customer','code'));
    }
    public function dnTransaction(){
        $customer = Vendor::all();
        $code = MegaTrend::getLastCode('DT','dn_transaction','dn_transaction_no');
        return view('modules.dashboard.dnTransaction_dashboard',compact('customer','code'));
    }
    public function creditNote(){
        $customer = Customer::all();
        return view('modules.dashboard.creditNote_dashboard',compact('customer'));
    }
    public function debitNote(){
        $customer = Vendor::all();
        return view('modules.dashboard.debitNote_dashboard',compact('customer'));
    }
    public function employee(){
        $branch = Branch::all();
        $code = MegaTrend::getLastCode('EM','employee','employee_no');
        return view('modules.dashboard.employee_dashboard',compact('code','branch'));
    }
    public function jsDesign(){
        return view('modules.dashboard.jsDesign');
    }
    public function jsDesignPreview(){
        return view('modules.report.preview');
    }
    public function currency(){
        $code = MegaTrend::getLastCode("C","currency","code");
        return view('modules.dashboard.currency',compact('code'));
    }
    public function branch(){
        $code = MegaTrend::getLastCode("B","branch","code");
        return view('modules.dashboard.branch',compact('code'));
    }
    public function productCoa(){
        $product = Product::all();
        $coalist = CoaControl::all();
        return view('modules.dashboard.productCoa',compact('coalist','product'));
    }
    public function promotion(){
        return view('modules.dashboard.users');
    }
    public function users(){
        return view('modules.dashboard.users_dashboard');
    }
}
