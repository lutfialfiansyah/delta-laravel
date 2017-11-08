<?php

use Illuminate\Http\Request;
use App\Helpers\MegaTrend;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
*****BRAND*****
*/
    Route::post('/brand/addData', [
        'uses' => 'ProductBrandController@addData',
        'as' => 'productbrand.addData'
    ]);
    Route::post('/brand/updateData/{id}', [
        'uses' => 'ProductBrandController@updateData',
        'as' => 'productbrand.updateData'
    ]);
    Route::get('/brand/getData', [
        'uses' => 'ProductBrandController@getData',
        'as' => 'productbrand.getData'
    ]);
    Route::get('/brand/deleteData/{id}', [
        'uses' => 'ProductBrandController@deleteData',
        'as' => 'brand.deleteData'
    ]);
    Route::get('/brand/getAllData/', [
        'uses' => 'ProductBrandController@getAllData',
        'as' => 'brand.getAllData'
    ]);
    Route::get('/customer_group/getAllData/', [
        'uses' => 'CustomerGroupController@getAllData',
        'as' => 'customer_group.getAllData'
    ]);



    /*
    *****PRODUCT*****
    */
    Route::post('/product/addData', [
        'uses' => 'ProductController@addData',
        'as' => 'product.addData'
    ]);
        Route::post('/product/addDatas', [
        'uses' => 'ProductController@addDatas',
        'as' => 'product.addDatas'
    ]);
    Route::get('/product/restoreData/{id}', [
        'uses' => 'ProductController@restoreData',
        'as' => 'product.restoreData'
    ]);
    Route::get('/product/cekStock/{id}', [
        'uses' => 'ProductController@cekStock',
        'as' => 'product.cekStock'
    ]);
    Route::get('/product/getDataRecycle', [
        'uses' => 'ProductController@getDataRecycle',
        'as' => 'product.getDataRecycle'
    ]);
    Route::get('/product/getData', [
        'uses' => 'ProductController@getData',
        'as' => 'product.getData'
    ]);
    Route::post('/product/getProduct', [
        'uses' => 'ProductController@getProduct',
        'as' => 'product.getProduct'
    ]);
    Route::post('/product/updateData/{id}', [
        'uses' => 'ProductController@updateData',
        'as' => 'product.updateData'
    ]);

    Route::get('/product/deleteData/{id}', [
        'uses' => 'ProductController@deleteData',
        'as' => 'product.deleteData'
    ]);
    Route::get('/product/getPriceProduct/{id}', [
        'uses' => 'ProductController@getPriceProduct',
        'as' => 'product.getPriceProduct'
    ]);
    /*
    *****FILTER PRODUCT*****
    */
    Route::get('/product/getSelect2Unit',[
        'uses' => 'ProductController@getSelect2Unit',
        'as' => 'product.getSelect2Unit'
    ]);
    Route::get('/product/getSelect2Type',[
        'uses' => 'ProductController@getSelect2Type',
        'as' => 'product.getSelect2Type'
    ]);
    Route::get('/product/getSelect2SubCat',[
        'uses' => 'ProductController@getSelect2SubCat',
        'as' => 'product.getSelect2SubCat'
    ]);
    Route::get('/product/getSelect2Category',[
        'uses' => 'ProductController@getSelect2Category',
        'as' => 'product.getSelect2Category'
    ]);
    Route::get('/product/getSelect2Brand',[
        'uses' => 'ProductController@getSelect2Brand',
        'as' => 'product.getSelect2Brand'
    ]);
    Route::get('/product/getSelect2Group',[
        'uses' => 'ProductController@getSelect2Group',
        'as' => 'product.getSelect2Group'
    ]);

    /*
    *****STOCK Beginning*****
    */
    Route::get('/stockBeginning/getData', [
        'uses' => 'StockBeginningController@getData',
        'as' => 'stockBeginning.getData'
    ]);
    Route::post('/stockBeginning/addData', [
        'uses' => 'StockBeginningController@addData',
        'as' => 'stockBeginning.addData'
    ]);
    Route::post('/stockBeginning/updateData/{id}', [
        'uses' => 'StockBeginningController@updateData',
        'as' => 'stockBeginning.updateData'
    ]);
    Route::get('/stockBeginning/deleteData/{id}', [
        'uses' => 'StockBeginningController@deleteData',
        'as' => 'stockBeginning.deleteData'
    ]);
    Route::get('/stockBeginning/getAllData',[
        'uses' => 'COA\CoaListController@getAllData',
        'as' => 'stock.getAllData'
    ]);



    /*
    *****PRODUCT TYPE*****
    */
    Route::get('/productType/getData', [
        'uses' => 'ProductTypeController@getData',
        'as' => 'productType.getData'
    ]);
    Route::post('/productType/addData', [
        'uses' => 'ProductTypeController@addData',
        'as' => 'productType.addData'
    ]);
    Route::post('/productType/updateData/{id}', [
        'uses' => 'ProductTypeController@updateData',
        'as' => 'productType.updateData'
    ]);
    Route::get('/productType/deleteData/{id}', [
        'uses' => 'ProductTypeController@deleteData',
        'as' => 'productType.deleteData'
    ]);
    Route::get('/productType/getAllData/', [
        'uses' => 'ProductTypeController@getAllData',
        'as' => 'productType.getAllData'
    ]);
    /*
    *****PRODUCT GROUP*****
    */
    Route::get('/productGroup/getData', [
        'uses' => 'ProductGroupController@getData',
        'as' => 'productGroup.getData'
    ]);
    Route::get('/productGroup/deleteData/{id}', [
        'uses' => 'ProductGroupController@deleteData',
        'as' => 'productGroup.deleteData'
    ]);
    Route::post('/productGroup/addData', [
        'uses' => 'ProductGroupController@addData',
        'as' => 'productGroup.addData'
    ]);
    Route::post('/productGroup/updateData/{id}', [
        'uses' => 'ProductGroupController@updateData',
        'as' => 'productGroup.updateData'
    ]);
    Route::get('/productGroup/getAllData',[
        'uses' => 'ProductGroupController@getAllData',
        'as' => 'productGroup.getAllData'
    ]);


    /*
    *****CUSTOMER GROUP*****
    */
    Route::get('/customerGroup/getData', [
        'uses' => 'CustomerGroupController@getData',
        'as' => 'customerGroup.getData'
    ]);
    Route::post('/customerGroup/addData', [
        'uses' => 'CustomerGroupController@addData',
        'as' => 'customerGroup.addData'
    ]);
    Route::post('/customerGroup/updateData/{id}', [
        'uses' => 'CustomerGroupController@updateData',
        'as' => 'customerGroup.updateData'
    ]);
    Route::get('/customerGroup/deleteData/{id}', [
        'uses' => 'CustomerGroupController@deleteData',
        'as' => 'customerGroup.deleteData'
    ]);


    /*
    *****CUSTOMER*****
    */
    Route::get('/customer/getData', [
        'uses' => 'CustomerController@getData',
        'as' => 'customer.getData'
    ]);
    Route::post('/customer/addData', [
        'uses' => 'CustomerController@addData',
        'as' => 'customer.addData'
    ]);
    Route::post('/customer/updateData/{id}', [
        'uses' => 'CustomerController@updateData',
        'as' => 'customer.updateData'
    ]);
    Route::get('/customer/deleteData/{id}', [
        'uses' => 'CustomerController@deleteData',
        'as' => 'customer.deleteData'
    ]);
    /*
    *****PRICE*****
    */
    Route::get('/price/getData', [
        'uses' => 'PriceController@getData',
        'as' => 'price.getData'
    ]);
    Route::post('/price/addData', [
        'uses' => 'PriceController@addData',
        'as' => 'price.addData'
    ]);
    Route::post('/price/updateData/{id}', [
        'uses' => 'PriceController@updateData',
        'as' => 'price.updateData'
    ]);
    Route::get('/price/deleteData/{id}', [
        'uses' => 'PriceController@deleteData',
        'as' => 'price.deleteData'
    ]);

    /*
    *****Shipping Method*****
    */
    Route::get('/delivery/getData', [
        'uses' => 'DeliveryController@getData',
        'as' => 'delivery.getData'
    ]);
    Route::post('/delivery/addData', [
        'uses' => 'DeliveryController@addData',
        'as' => 'delivery.addData'
    ]);
    Route::post('/delivery/updateData/{id}', [
        'uses' => 'DeliveryController@updateData',
        'as' => 'delivery.updateData'
    ]);
    Route::get('/delivery/deleteData/{id}', [
        'uses' => 'DeliveryController@deleteData',
        'as' => 'delivery.deleteData'
    ]);

    /*
    *****Purchase Order*****
    */
    Route::get('/purchaseOrder/getData', [
        'uses' => 'PurchaseOrderController@getData',
        'as' => 'purchaseOrder.getData'
    ]);
    Route::post('/purchaseOrder/addData', [
        'uses' => 'PurchaseOrderController@addData',
        'as' => 'purchaseOrder.addData'
    ]);
    Route::post('/purchaseOrder/addProduct', [
        'uses' => 'PurchaseOrderController@addProduct',
        'as' => 'purchaseOrder.addProduct'
    ]);
    Route::post('/purchaseOrder/updateData/{id}', [
        'uses' => 'PurchaseOrderController@updateData',
        'as' => 'purchaseOrder.updateData'
    ]);
    Route::post('/purchaseOrder/updateProduct/{id}', [
        'uses' => 'PurchaseOrderController@updatePrice',
        'as' => 'purchaseOrder.updateProduct'
    ]);
    Route::get('/purchaseOrder/deleteData/{id}', [
        'uses' => 'PurchaseOrderController@deleteData',
        'as' => 'purchaseOrder.deleteData'
    ]);
    Route::get('/purchaseOrder/getDetail/{id}', [
        'uses' => 'PurchaseOrderController@getDetail',
        'as' => 'purchaseOrder.getDetail'
    ]);
    Route::get('/purchaseOrder/deletePO/{id}', [
        'uses' => 'PurchaseOrderController@deletePO',
        'as' => 'purchaseOrder.deletePO'
    ]);
    Route::get('/purchaseOrder/deleteProduct/{id}', [
        'uses' => 'PurchaseOrderController@deleteProduct',
        'as' => 'purchaseOrder.deleteProduct'
    ]);


    /*
    *****CATEGORY*****
    */
Route::get('/category/getAllData/',[
    'uses' => 'CategoryController@getAllData',
    'as' => 'category.getAllData'
]);


    /*
    *****Purchase*****
    */
    Route::get('/purchase/getData', [
        'uses' => 'PurchaseController@getData',
        'as' => 'purchase.getData'
    ]);
    Route::post('/purchase/addData', [
        'uses' => 'PurchaseController@addData',
        'as' => 'purchase.addData'
    ]);
    Route::post('/purchase/updateData/{id}', [
        'uses' => 'PurchaseController@updateData',
        'as' => 'purchase.updateData'
    ]);
    Route::get('/purchase/deleteData/{id}', [
        'uses' => 'PurchaseController@deleteData',
        'as' => 'purchase.deleteData'
    ]);
    Route::get('/purchase/deleteProduct/{id}', [
        'uses' => 'PurchaseController@deleteProduct',
        'as' => 'purchase.deleteProduct'
    ]);
    Route::post('/purchase/addProduct', [
        'uses' => 'PurchaseController@addProduct',
        'as' => 'purchase.addProduct'
    ]);
    Route::post('/purchase/updateProduct/{id}', [
        'uses' => 'PurchaseController@updatePrice',
        'as' => 'purchase.updateProduct'
    ]);
    Route::get('/productUnit/getProductUnit/{id}', [
        'uses' => 'UnitConversionController@getProductUnit',
        'as' => 'productUnit.getProductUnit'
    ]);
    Route::get('/productUnit/getProductUnit', [
        'uses' => 'UnitConversionController@getProductUnit2',
        'as' => 'productUnit.getProductUnit'
    ]);
    Route::get('/product/getUnitPerProd/{id}', [
        'uses' => 'ProductController@getUnitPerProd',
        'as' => 'product.getUnitPerProd'
    ]);
    Route::get('/product/getUnitCon', [
        'uses' => 'ProductController@getUnitCon',
        'as' => 'product.getUnitCon'
    ]);
    Route::get('/product/getUnit', [
        'uses' => 'ProductController@getUnit',
        'as' => 'product.getUnit'
    ]);
    Route::get('/subCategory/getcat', function () {
        return \App\ProductCategory::where('name', 'like', '%' . request('q') . '%')->paginate(10);
    });
    //UNITCONVERSION
    Route::post('/unitconversion/cekUnitData', [
        'uses' => 'UnitConversionController@cekUnitData',
        'as' => 'unitcon.cekunit'
    ]);
    //UNIT
    Route::get('/unit/getAllData',[
        'uses' => 'UnitController@getAllData',
        'as' => 'unit.getAllData'
    ]);

    //SUBCATEGORY
    Route::get('/subCategory/getAllData',[
        'uses' => 'SubCategoryController@getAllData',
        'as' => 'subCategory.getAllData'
    ]);

    //Purchase Return
    Route::get('/purchaseReturn/getData', [
        'uses' => 'PurchaseReturnController@getData',
        'as' => 'purchaseReturn.getData'
    ]);
    Route::post('/purchaseReturn/addData', [
        'uses' => 'PurchaseReturnController@addData',
        'as' => 'purchaseReturn.addData'
    ]);
    Route::post('/purchaseReturn/addProduct', [
        'uses' => 'PurchaseReturnController@addProduct',
        'as' => 'purchaseReturn.addProduct'
    ]);
    Route::post('/purchaseReturn/updateData/{id}', [
        'uses' => 'PurchaseReturnController@updateData',
        'as' => 'purchaseReturn.updateData'
    ]);
    Route::post('/purchaseReturn/updateProduct/{id}', [
        'uses' => 'PurchaseReturnController@updateProduct',
        'as' => 'purchaseReturn.updateProduct'
    ]);
    Route::get('/purchaseReturn/getAllData',[
        'uses' => 'PurchaseReturnController@getAllData',
        'as' => 'purchaseReturn.getAllData'
        ]);

    //Vendor Group
    Route::get('/vendorGroup/getData', [
        'uses' => 'vendorGroupController@getData',
        'as' => 'vendorGroup.getData'
    ]);
    Route::post('/vendorGroup/addData', [
        'uses' => 'vendorGroupController@addData',
        'as' => 'vendorGroup.addData'
    ]);
    Route::post('/vendorGroup/updateData/{id}', [
        'uses' => 'vendorGroupController@updateData',
        'as' => 'vendorGroup.updateData'
    ]);

    //SalesMan
    Route::get('/salesman/getData', [
        'uses' => 'SalesmanController@getData',
        'as' => 'salesman.getData'
    ]);
    Route::post('/salesman/addData', [
        'uses' => 'SalesmanController@addData',
        'as' => 'salesman.addData'
    ]);
    Route::post('/salesman/updateData/{id}', [
        'uses' => 'SalesmanController@updateData',
        'as' => 'salesman.updateData'
    ]);
    Route::get('/salesman/deleteData/{id}', [
        'uses' => 'SalesmanController@deleteData',
        'as' => 'salesman.deleteData'
    ]);

    //SalesTransaction
    Route::get('/salesTransaction/getData', [
        'uses' => 'SalesTransactionController@getData',
        'as' => 'salesTransaction.getData'
    ]);
    Route::post('/salesTransaction/addData', [
        'uses' => 'SalesTransactionController@addData',
        'as' => 'salesTransaction.addData'
    ]);
    Route::post('/salesTransaction/updateData/{id}', [
        'uses' => 'SalesTransactionController@updateData',
        'as' => 'salesTransaction.updateData'
    ]);
    Route::post('/salesTransaction/addProduct', [
        'uses' => 'SalesTransactionController@addProduct',
        'as' => 'salesTransaction.addProduct'
    ]);
    Route::post('/salesTransaction/updateProduct/{id}', [
        'uses' => 'SalesTransactionController@updatePrice',
        'as' => 'salesTransaction.updateProduct'
    ]);
    Route::get('/salesTransaction/getAllData',[
        'uses' => 'SalesTransactionController@getAllData',
        'as' => 'sales_trans.getAllData'
    ]);


    //salesOrder
    Route::post('/salesOrder/addData', [
        'uses' => 'SalesOrderController@addData',
        'as' => 'salesOrder.addData'
    ]);
    Route::get('/salesOrder/getData', [
        'uses' => 'SalesOrderController@getData',
        'as' => 'salesOrder.getData'
    ]);
    Route::get('/salesOrder/getDetail/{id}', [
        'uses' => 'SalesOrderController@getDetail',
        'as' => 'salesOrder.getDetail'
    ]);


    //salesReturn
    Route::get('/salesReturn/getData', [
        'uses' => 'SalesReturnController@getData',
        'as' => 'salesReturn.getData'
    ]);
    Route::post('/salesReturn/addData', [
        'uses' => 'SalesReturnController@addData',
        'as' => 'salesReturn.addData'
    ]);
    Route::post('/salesReturn/addProduct', [
        'uses' => 'SalesReturnController@addProduct',
        'as' => 'salesReturn.addProduct'
    ]);
    Route::post('/salesReturn/updateData/{id}', [
        'uses' => 'SalesReturnController@updateData',
        'as' => 'purchaseReturn.updateData'
    ]);
    Route::post('/salesReturn/updateProduct/{id}', [
        'uses' => 'SalesReturnController@updateProduct',
        'as' => 'salesReturn.updateProduct'
    ]);
    Route::get('/salesReturn/getAllData/',[
        'uses' => 'SalesReturnController@getAllData',
        'as' => 'salesReturn.getAllData'
    ]);

    //account payable
    Route::get('/accountPayable/getData', [
        'uses' => 'AccountPayableController@getData',
        'as' => 'accountPayable.getData'
    ]);
    Route::post('/accountPayable/addData', [
        'uses' => 'AccountPayableController@addData',
        'as' => 'accountPayable.addData'
    ]);
    Route::post('/accountPayable/updateData/{id}', [
        'uses' => 'AccountPayableController@updateData',
        'as' => 'accountPayable.updateData'
    ]);
    Route::get('/accountPayable/deleteData/{id}', [
        'uses' => 'AccountPayableController@deleteData',
        'as' => 'accountPayable.deleteData'
    ]);

    //accountreceivable
    Route::get('/accountReceivable/getData', [
        'uses' => 'AccountReceivableController@getData',
        'as' => 'accountReceivable.getData'
    ]);
    Route::post('/accountReceivable/addData', [
        'uses' => 'AccountReceivableController@addData',
        'as' => 'accountReceivable.addData'
    ]);
    Route::post('/accountReceivable/updateData/{id}', [
        'uses' => 'AccountReceivableController@updateData',
        'as' => 'accountReceivable.updateData'
    ]);
    Route::get('/accountReceivable/deleteData/{id}', [
        'uses' => 'AccountReceivableController@deleteData',
        'as' => 'accountReceivable.deleteData'
    ]);

    //CreditNote
    Route::get('/creditNoteType/getData', [
        'uses' => 'CreditNoteController@getData',
        'as' => 'creditNoteType.getData'
    ]);
    Route::post('/creditNoteType/addData', [
        'uses' => 'CreditNoteController@addData',
        'as' => 'creditNoteType.addData'
    ]);
    Route::post('/creditNoteType/updateData/{id}', [
        'uses' => 'CreditNoteController@updateData',
        'as' => 'creditNoteType.updateData'
    ]);
    //DebitNote
    Route::get('/debitNoteType/getData', [
        'uses' => 'DebitNoteController@getData',
        'as' => 'debitNoteType.getData'
    ]);
    Route::post('/debitNoteType/addData', [
        'uses' => 'DebitNoteController@addData',
        'as' => 'debitNoteType.addData'
    ]);
    Route::post('/debitNoteType/updateData/{id}', [
        'uses' => 'DebitNoteController@updateData',
        'as' => 'debitNoteType.updateData'
    ]);

    //apPayment
    Route::get('/apPayment/getData', [
        'uses' => 'ApPaymentController@getData',
        'as' => 'apPayment.getData'
    ]);
    Route::get('/purchase/getPurchaseNoByVendor/{id}', [
        'uses' => 'PurchaseController@getPurchaseNoByVendor',
        'as' => 'purchase.getPurchaseNoByVendor'
    ]);
    Route::post('/apPayment/addData', [
        'uses' => 'ApPaymentController@addData',
        'as' => 'apPayment.addData'
    ]);
    Route::post('/apPayment/updateData/{id}', [
        'uses' => 'ApPaymentController@updateData',
        'as' => 'apPayment.updateData'
    ]);

    //Ar Payment
    Route::get('/arPayment/getData', [
        'uses' => 'ArPaymentController@getData',
        'as' => 'arPayment.getData'
    ]);
    Route::get('/salesTransaction/getSalesTransNoByCustomer/{id}', [
        'uses' => 'SalesTransactionController@getSalesTransNoByCustomer',
        'as' => 'salesTransaction.getSalesTransNoByCustomer'
    ]);
    Route::post('/arPayment/addData', [
        'uses' => 'ArPaymentController@addData',
        'as' => 'arPayment.addData'
    ]);
    Route::post('/arPayment/updateData/{id}', [
        'uses' => 'ArPaymentController@updateData',
        'as' => 'arPayment.updateData'
    ]);

    //Coa List
    Route::get('/coalist/getData', [
        'uses' => 'COA\CoaListController@getData',
        'as' => 'coalist.getData'
    ]);
    Route::post('/coalist/addData', [
        'uses' => 'COA\CoaListController@addData',
        'as' => 'coalist.addData'
    ]);
    Route::post('/coalist/updateData/{id}', [
        'uses' => 'COA\CoaListController@updateData',
        'as' => 'coalist.updateData'
    ]);

    //Coa control
    Route::get('/coaControl/getData', [
        'uses' => 'COA\CoaControlController@getData',
        'as' => 'coaControl.getData'
    ]);
    Route::post('/coaControl/addData', [
        'uses' => 'COA\CoaControlController@addData',
        'as' => 'coaControl.addData'
    ]);
    Route::post('/coaControl/updateData/{id}', [
        'uses' => 'COA\CoaControlController@updateData',
        'as' => 'coaControl.updateData'
    ]);

    //cn Transaction
    Route::get('cnTransaction/getData', [
        'uses' => 'CN\CnTransactionController@getData',
        'as' => 'cnTransaction.getData'
    ]);
    Route::post('/cnTransaction/addData', [
        'uses' => 'CN\CnTransactionController@addData',
        'as' => 'cnTransaction.addData'
    ]);
    Route::post('/cnTransaction/updateData/{id}', [
        'uses' => 'CN\CnTransactionController@updateData',
        'as' => 'cnTransaction.updateData'
    ]);
    Route::get('/cnTransaction/getCnTransactionById/{id}', [
        'uses' => 'CN\CnTransactionController@getCnTransactionById',
        'as' => 'cnTransaction.getCnTransactionById'
    ]);

    //DN Transaction
    Route::get('dnTransaction/getData', [
        'uses' => 'DN\DnTransactionController@getData',
        'as' => 'dnTransaction.getData'
    ]);
    Route::post('/dnTransaction/addData', [
        'uses' => 'DN\DnTransactionController@addData',
        'as' => 'dnTransaction.addData'
    ]);
    Route::post('/dnTransaction/updateData/{id}', [
        'uses' => 'DN\DnTransactionController@updateData',
        'as' => 'dnTransaction.updateData'
    ]);
    Route::get('/dnTransaction/getDnTransactionById/{id}', [
        'uses' => 'DN\DnTransactionController@getDnTransactionById',
        'as' => 'cnTransaction.getDnTransactionById'
    ]);
    //creditNote
    Route::get('creditNote/getData', [
        'uses' => 'CN\CnTransactionController@getDataCn',
        'as' => 'creditNote.getData'
    ]);
    Route::post('/creditNote/addData', [
        'uses' => 'CN\CnTransactionController@addDataCn',
        'as' => 'creditNote.addData'
    ]);

    //creditNote
    Route::get('debitNote/getData', [
        'uses' => 'DebitNoteController@getDataDn',
        'as' => 'debitNote.getData'
    ]);
    Route::post('/debitNote/addData', [
        'uses' => 'DebitNoteController@addDataDn',
        'as' => 'debitNote.addData'
    ]);

    //currency
    Route::get('currency/getData', [
        'uses' => 'currencyController@getData',
        'as' => 'currency.getData'
    ]);
    Route::post('/currency/addData', [
        'uses' => 'currencyController@addData',
        'as' => 'currency.addData'
    ]);
    Route::post('/currency/updateData/{id}', [
        'uses' => 'currencyController@updateData',
        'as' => 'currency.updateData'
    ]);
    //branch
    Route::get('branch/getData', [
        'uses' => 'BranchController@getData',
        'as' => 'branch.getData'
    ]);
    Route::post('/branch/addData', [
        'uses' => 'BranchController@addData',
        'as' => 'branch.addData'
    ]);
    Route::post('/branch/updateData/{id}', [
        'uses' => 'BranchController@updateData',
        'as' => 'branch.updateData'
    ]);

    //creditNote
    Route::get('employee/getData', [
        'uses' => 'EmployeeController@getData',
        'as' => 'employee.getData'
    ]);
    Route::get('employee/getAllData', [
        'uses' => 'EmployeeController@getAllData',
        'as' => 'employee.getAllData'
    ]);
    Route::post('/employee/addData', [
        'uses' => 'EmployeeController@addData',
        'as' => 'employee.addData'
    ]);
    Route::post('/employee/updateData/{id}', [
        'uses' => 'EmployeeController@updateData',
        'as' => 'employee.updateData'
    ]);
    Route::get('coaList/getLastCode/{id}',[
        'uses'=>'COA\CoaPivotParentController@getLastCode',
        'as'=>'coaList.getLastCode'
    ]);

    //Report
    Route::get('report/getReport/{id}',[
        'uses'=>'Report\ReportController@getReport',
        'as'=>'report.getReport'
    ]);
    Route::get('report/getSchema',[
        'uses'=>'Report\ReportController@getSchema',
        'as'=>'report.getSchema'
    ]);
    Route::get('report/getAllData',[
        'uses'=>'Report\ReportController@getAllData',
        'as'=>'report.getAllData'
    ]);
    Route::post('report/updateReport',[
        'uses'=>'Report\ReportController@updateReport',
        'as'=>'report.updateReport'
    ]);


    //product coa
Route::get('productCoa/getData',[
    'uses'=>'COA\productCoaController@getData',
    'as'=>'productCoa.getData'
]);
Route::post('/productCoa/addData', [
    'uses' => 'COA\productCoaController@addData',
    'as' => 'productCoa.addData'
]);
//Branch
Route::get('branch/getBranch',[
    'uses'=>'BranchController@getBranch',
    'as'=>'branch.getBranch'
]);

//autocomplite
Route::get('product/getAllData',[
    'uses'=>'ProductController@getAllData',
    'as'=>'product.getAllData'
]);
Route::get('product/getAllsData',[
    'uses'=>'ProductController@getAllsData',
    'as'=>'product.getAllsData'
]);
Route::get('product/getAllDataPO',[
    'uses'=>'ProductController@getAllDataPO',
    'as'=>'product.getAllDataPO'
]);
Route::get('customer/getAllData',[
    'uses'=>'CustomerController@getAllData',
    'as'=>'customer.getAllData'
]);
Route::get('/paymentTerm/getAllData', [
    'uses' => 'PaymentTermController@getAllData',
    'as' => 'paymentTerm.getAllData'
]);
Route::get('/delivery/getAllData', [
    'uses' => 'DeliveryController@getAllData',
    'as' => 'delivery.getAllData'
]);
Route::get('currency/getAllData', [
    'uses' => 'currencyController@getAllData',
    'as' => 'currency.getAllData'
]);
Route::get('/salesOrder/getAllData', [
    'uses' => 'SalesOrderController@getAllData',
    'as' => 'salesOrder.getAllData'
]);
Route::get('/purchaseOrder/getAllData', [
    'uses' => 'PurchaseOrderController@getAllData',
    'as' => 'purchaseOrder.getAllData'
]);
Route::get('/werehouse/getAllData', [
    'uses' => 'WarehouseController@getAllData',
    'as' => 'werehouse.getAllData'
    ]);
Route::get('/vendor/getAllData', [
    'uses' => 'VendorController@getAllData',
    'as' => 'vendor.getAllData'
    ]);
Route::get('/salesman/getAllData', [
    'uses' => 'SalesmanController@getAllData',
    'as' => 'salesman.getaAllData'
]);
Route::get('/tax/getAllData', [
    'uses' => 'tax\TaxController@getAllData',
    'as' => 'tax.getaAllData'
]);

Route::get('product/getDataById/{id}',[
    'uses'=>'ProductController@getDataById',
    'as'=>'product.getDataById'
]);

Route::get('product/getDataById/{id}',[
    'uses'=>'ProductController@getDataById',
    'as'=>'product.getDataById'
]);


Route::get('promotion/getData', [
    'uses' => 'Promotion\PromotionController@getData',
    'as' => 'promotion.getData'
]);
Route::post('promotion/addData', [
    'uses' => 'Promotion\PromotionController@addData',
    'as' => 'promotion.addData'
]);
Route::post('promotion/update/{id}', [
    'uses' => 'Promotion\PromotionController@update',
    'as' => 'promotion.update'
]);
Route::get('promotion/cekPromotion', [
    'uses' => 'Promotion\PromotionController@cekPromotion',
    'as' => 'promotion.cekPromotion'
]);

Route::get('users/getData', [
    'uses' => 'UsersController@getData',
    'as' => 'users.getData'
]);
Route::post('users/addData', [
    'uses' => 'UsersController@addData',
    'as' => 'users.addData'
]);
Route::get('product/getItemNO/{id}',function($id){
    echo $code = MegaTrend::getLastCodeProduct($id);
});
