<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*****HOME*****
*/

Route::get('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('cek', 'DashboardController@cek');
Route::post('login/ceklogin', [
    'uses' => 'Auth\LoginController@ceklogin',
    'as' => 'login.ceklogin'
]);
Route::get('cek', 'DashboardController@cek');
Auth::routes();
Route::group(['middleware'=>['auth','web']],function(){
    Route::get('/', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    Route::get('/home', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    Route::get('/product',[
        'uses' => 'DashboardController@product',
        'as' => 'product'
    ]);
    Route::get('/vendorGroup',[
        'uses' => 'DashboardController@vendorGroup',
        'as' => 'vendorGroup'
    ]);
    Route::get('/productType',[
        'uses' => 'DashboardController@productType',
        'as' => 'productType'
    ]);
    Route::get('/productGroup',[
        'uses' => 'DashboardController@productGroup',
        'as' => 'productGroup'
    ]);
    Route::get('/customerGroup',[
        'uses' => 'DashboardController@customerGroup',
        'as' => 'customergroup'
    ]);
    Route::get('/customer',[
        'uses' => 'DashboardController@customer',
        'as' => 'customer'
    ]);

    //PRODUCT
    Route::get('/product/insert_product',[
        'uses' => 'ProductController@insertproduct',
        'as' => 'insert.product'
    ]);
    Route::get('/product/insert_productv2',[
        'uses' => 'ProductController@insertproductv2',
        'as' => 'insert.productv2'
    ]);
    Route::get('/product/detail_product/{id}',[
        'uses' => 'ProductController@detailproduct',
        'as' => 'product.detail'
    ]);
    Route::get('/product/edit_product/{id}',[
        'uses' => 'ProductController@editproduct',
        'as' => 'product.edit'
    ]);
    Route::post('/product/updateData/{id}',[
        'uses' => 'ProductController@updateData',
        'as' => 'product.update'
    ]);
    /*
    *****BRAND*****
    */
    Route::get('/brand',[
        'uses' => 'DashboardController@brand',
        'as' => 'brand'
    ]);
    Route::get('/brand/edit/{id}',[
        'uses' => 'ProductBrandController@getedit',
        'as' => 'brand.edit'
    ]);
    /*
    *****Product Subs Category*****
    */
    Route::get('/productcategory/getSubCategory/{id}',[
        'uses' => 'ProductController@getSubCategory',
        'as'=>'product.getSubCategory'
    ]);
    Route::get('/vendor/getPaymentTerm/{id}',[
        'uses' => 'VendorController@getPaymentTerm',
        'as'=>'vendor.getPaymentTerm'
    ]);
    Route::get('/vendor/getPaymentTermId/{id}',[
        'uses' => 'VendorController@getPaymentTermId',
        'as'=>'vendor.getPaymentTermId'
    ]);

    /*
    *****Stock Begining*****
    */
    Route::get('/stockBeginning',[
        'uses' => 'DashboardController@stockBeginning',
        'as' => 'stock.beginning'
    ]);
    /*
    *****CATEGORY*****
    */
    Route::get('/category',[
        'uses' => 'DashboardController@category',
        'as' => 'category'
    ]);
    Route::get('/category/getData',[
        'uses' => 'CategoryController@getData',
        'as' => 'category.getData'
    ]);
    Route::post('/category/addData',[
        'uses' => 'CategoryController@addData',
        'as' => 'category.addData'
    ]);
    Route::post('/category/updateData/{id}',[
        'uses' => 'CategoryController@updateData',
        'as' => 'category.updateData'
    ]);
    Route::get('/category/deleteData/{id}',[
        'uses' => 'CategoryController@deleteData',
        'as' => 'category.deleteData'
    ]);
    /*
    *****SUB_CATEGORY*****
    */
    Route::get('/subCategory',[
        'uses' => 'DashboardController@subCategory',
        'as' => 'subCategory'
    ]);
    Route::get('/subCategory/getData',[
        'uses' => 'SubCategoryController@getData',
        'as' => 'subCategory.getData'
    ]);
    Route::post('/subCategory/addData',[
        'uses' => 'SubCategoryController@addData',
        'as' => 'subCategory.addData'
    ]);
    Route::post('/subCategory/updateData/{id}',[
        'uses' => 'SubCategoryController@updateData',
        'as' => 'subCategory.updateData'
    ]);
    Route::get('/subCategory/deleteData/{id}',[
        'uses' => 'SubCategoryController@deleteData',
        'as' => 'subCategory.deleteData'
    ]);
    /*
    *****WAREHOUSE*****
    */
    Route::get('/warehouse', [
        'uses' => 'DashboardController@warehouse',
        'as' => 'warehouse'
    ]);
    Route::get('/warehouse/insert_warehouse', [
        'uses' => 'WarehouseController@insertWarehouse',
        'as' => 'warehouse.insertWarehouse'
    ]);
    Route::get('/warehouse/getData', [
        'uses' => "WarehouseController@getData",
        'as' => 'warehouse.getData'
    ]);
    Route::post('/warehouse/addData', [
        'uses' => 'WarehouseController@addData',
        'as' => 'warehouse.addData'
    ]);
    Route::get('/warehouse/updateWarehouse/{id}', [
        'uses' => 'WarehouseController@updateWarehouse',
        'as' => 'warehouse.updateWarehouse'
    ]);
    Route::post('/warehouse/updateData/{id}', [
        'uses' => 'WarehouseController@updateData',
        'as' => 'warehouse.updateData'
    ]);
    Route::get('/warehouse/deleteData/{id}', [
        'uses' => 'WarehouseController@deleteData',
        'as' => 'warehouse.deleteData'
    ]);
    /*
    *****PAYMENTTERM*****
    */
    Route::get('/paymentTerm', [
        'uses' => 'DashboardController@paymentTerm',
        'as' => 'paymentTerm'
    ]);
    Route::get('/paymentTerm/getData', [
        'uses' => 'PaymentTermController@getData',
        'as' => 'paymentTerm.getData'
    ]);
    Route::post('/paymentTerm/addData', [
        'uses' => 'PaymentTermController@addData',
        'as' => 'paymentTerm.addData'
    ]);
    Route::post('/paymentTerm/updateData/{id}', [
        'uses' => 'PaymentTermController@updateData',
        'as' => 'paymentTerm.updateData'
    ]);
    Route::get('/paymentTerm/deleteData/{id}', [
        'uses' => 'PaymentTermController@deleteData',
        'as' => 'paymentTerm.deleteData'
    ]);
    /*
     * UNIT
     */
    Route::get('/unit',[
        'uses' => 'DashboardController@unit',
        'as' => 'unit.view'
    ]);
    Route::get('/unit/getData',[
        'uses' => 'UnitController@getData',
        'as' => 'unit.getData'
    ]);
    Route::post('/unit/addData',[
        'uses' => 'UnitController@addData',
        'as' => 'unit.addData'
    ]);
    Route::post('/unit/updateData/{id}',[
        'uses' => 'UnitController@updateData',
        'as' => 'unit.updateData'
    ]);
    Route::get('/unit/deleteData/{id}',[
        'uses' => 'UnitController@deleteData',
        'as' => 'unit.deleteData'
    ]);
    /*
     * Customer
     */
    Route::get('/customer/insert_customer',[
        'uses' => 'CustomerController@insertcustomer',
        'as' => 'insert.customer'
    ]);
    Route::get('/customer/detail_customer/{id}',[
        'uses' => 'CustomerController@detailcustomer',
        'as' => 'detail.customer'
    ]);
    Route::get('/customer/edit_customer/{id}',[
        'uses' => 'CustomerController@editcustomer',
        'as' => 'edit.customer'
    ]);
    /*
     * PRODUCT UNIT
     */
    Route::get('/unitconversion',[
        'uses' => 'DashboardController@unitconversion',
        'as' => 'unitconversion.view'
    ]);
    Route::get('/unitconversion/getData',[
        'uses' => 'UnitConversionController@getData',
        'as' => 'unitconversion.getData'
    ]);
    Route::get('/unitconversion/insert_unitconversion',[
        'uses' => 'UnitConversionController@insert_unitconversion',
        'as' => 'insert.unitconversion'
    ]);
    Route::post('/unitconversion/addData',[
        'uses' => 'UnitConversionController@addData',
        'as' => 'unitconversion.addData'
    ]);
    Route::get('/unitconversion/editData/{id}',[
        'uses' => 'UnitConversionController@editData',
        'as' => 'unitconversion.editData'
    ]);
    Route::post('/unitconversion/updateData/{id}',[
        'uses' => 'UnitConversionController@updateData',
        'as' => 'unitconversion.updateData'
    ]);
    Route::get('/unitconversion/deleteData/{id}',[
        'uses' => 'UnitConversionController@deleteData',
        'as' => 'unitconversion.deleteData'
    ]);
    Route::post('/unitconversion/cekdata',[
        'uses' => 'UnitConversionController@cekData',
        'as' => 'unitcon.cekData'
    ]);


    /*
     * Price
     */
    Route::get('/price',[
        'uses' => 'DashboardController@price',
        'as' => 'price'
    ]);

    //Delivery/shipping Metod
    Route::get('/delivery',[
        'uses' => 'DashboardController@delivery',
        'as' => 'delivery'
    ]);
    Route::get('/delivery/insert_delivery',[
        'uses' => 'DeliveryController@insertDelivery',
        'as' => 'insert.delivery'
    ]);
    Route::get('/delivery/edit_delivery/{id}',[
        'uses' => 'DeliveryController@editDelivery',
        'as' => 'edit.delivery'
    ]);

    //Purchase Order//
    Route::get('/purchaseOrder',[
        'uses' => 'DashboardController@purchaseOrder',
        'as' => 'purchaseOrder'
    ]);
    Route::get('/purchaseOrder/detail/{id}',[
        'uses' => 'PurchaseOrderController@detailPurchaseOrder',
        'as' => 'detail.purchaseOrder'
    ]);
    Route::get('/purchaseOrder/insert_purchaseOrder',[
        'uses' => 'PurchaseOrderController@insertPurchaseOrder',
        'as' => 'insert.purchaseOrder'
    ]);
    Route::get('/purchaseOrder/edit_purchaseOrder/{id}',[
        'uses' => 'PurchaseOrderController@editPurchaseOrder',
        'as' => 'edit.purchaseOrder'
    ]);

    //Purchase//
    Route::get('/purchase',[
        'uses' => 'DashboardController@purchase',
        'as' => 'purchase'
    ]);
    Route::get('/purchase/detail/{id}',[
        'uses' => 'PurchaseController@detailPurchase',
        'as' => 'detail.purchase'
    ]);
    Route::get('/purchase/insert_purchase',[
        'uses' => 'PurchaseController@insertPurchase',
        'as' => 'insert.purchase'
    ]);
    Route::get('/purchase/edit_purchase/{id}',[
        'uses' => 'PurchaseController@editPurchase',
        'as' => 'edit.purchase'
    ]);

    //VENDOR
    Route::get('/vendors',[
        'uses' => 'DashboardController@vendors',
        'as' => 'vendors.view'
    ]);
    Route::get('/vendors/getData',[
        'uses' => 'VendorController@getData',
        'as' => 'vendors.getData'
    ]);
    Route::get('/vendors/insert_vendor',[
        'uses' => 'VendorController@insertVendor',
        'as' => 'insert.vendors'
    ]);
    Route::post('/vendors/addData',[
        'uses' => 'VendorController@addData',
        'as' => 'vendors.addData'
    ]);
    Route::get('/vendors/editData/{id}',[
        'uses' => 'VendorController@editData',
        'as' => 'vendors.editData'
    ]);
    Route::post('/vendors/updateData/{id}',[
        'uses' => 'VendorController@updateData',
        'as' => 'vendors.updateData'
    ]);
    Route::get('/vendors/deleteData/{id}',[
        'uses' => 'VendorController@deleteData',
        'as' => 'vendors.deleteData'
    ]);

    //Purchase Return
    Route::get('/purchaseReturn',[
        'uses' => 'DashboardController@purchaseReturn',
        'as' => 'purchaseReturn'
    ]);
    Route::get('/purchaseReturn/insert_purchaseReturn',[
        'uses' => 'PurchaseReturnController@insertPurchaseReturn',
        'as' => 'insert.purchaseReturn'
    ]);
    Route::get('/purchaseReturn/detail/{id}',[
        'uses' => 'PurchaseReturnController@detailPurchaseReturn',
        'as' => 'detail.purchaseReturn'
    ]);
    Route::get('/purchaseReturn/edit_purchaseReturn/{id}',[
        'uses' => 'PurchaseReturnController@editPurchaseReturn',
        'as' => 'edit.purchaseReturn'
    ]);

    //SalesMan
    Route::get('/salesman',[
        'uses' => 'DashboardController@salesman',
        'as' => 'salesman'
    ]);
    Route::get('/salesman/insert_salesman',[
        'uses' => 'SalesmanController@insertSalesman',
        'as' => 'insert.salesman'
    ]);
    Route::get('/salesman/detail/{id}',[
        'uses' => 'SalesmanController@detailSalesman',
        'as' => 'detail.salesman'
    ]);
    Route::get('/salesman/edit_salesman/{id}',[
        'uses' => 'SalesmanController@editSalesman',
        'as' => 'edit.salesman'
    ]);

//SalesMan
Route::get('/salesTransaction',[
    'uses' => 'DashboardController@salesTransaction',
    'as' => 'salesTransaction'
]);
Route::get('/salesTransaction/insert',[
    'uses' => 'SalesTransactionController@insertSalesTransaction',
    'as' => 'salesTransaction.insert'
]);
Route::get('/salesTransaction/detail/{id}',[
    'uses' => 'SalesTransactionController@detailSalesTransaction',
    'as' => 'salesTransaction.detail'
]);
Route::get('/salesTransaction/edit/{id}',[
    'uses' => 'SalesTransactionController@editSalesTransaction',
    'as' => 'salesTransaction.edit'
]);

//Sales Order
Route::get('/salesOrder',[
    'uses' => 'DashboardController@salesOrder',
    'as' => 'salesOrder'
]);
Route::get('/salesOrder/insert',[
    'uses' => 'SalesOrderController@insertsalesOrder',
    'as' => 'salesOrder.insert'
]);
Route::get('/salesOrder/edit/{id}',[
    'uses' => 'SalesOrderController@editSalesOrder',
    'as' => 'salesOrder.edit'
]);
Route::get('/salesOrder/detail/{id}',[
    'uses' => 'SalesOrderController@detailSalesOrder',
    'as' => 'salesOrder.detail'
]);


//Sales Return
Route::get('/salesReturn',[
   'uses' => 'DashboardController@salesReturn',
   'as' => 'salesReturn'
]);
Route::get('/salesReturn/insert_salesReturn',[
   'uses' => 'SalesReturnController@insertSalesReturn',
   'as' => 'salesReturn.insertSalesReturn'
]);
Route::get('/salesReturn/detail/{id}',[
    'uses' => 'SalesReturnController@detailSalesReturn',
    'as' => 'salesReturn.detail'
]);
Route::get('/salesReturn/edit_salesReturn/{id}',[
    'uses' => 'SalesReturnController@editSalesReturn',
    'as' => 'salesReturn.edit'
]);

//accountPayable
Route::get('/accountPayable',[
    'uses' => 'DashboardController@accountPayable',
    'as' => 'accountPayable'
]);

//accountReceivable
Route::get('/accountReceivable',[
    'uses' => 'DashboardController@accountReceivable',
    'as' => 'accountReceivable'
]);

//CN
Route::get('/creditNoteType',[
    'uses' => 'DashboardController@creditNoteType',
    'as' => 'creditNote.type'
]);
//DN
Route::get('/debitNoteType',[
    'uses' => 'DashboardController@debitNoteType',
    'as' => 'debitNote.type'
]);

//Ap Payment
Route::get('/apPayment',[
    'uses' => 'DashboardController@apPayment',
    'as' => 'apPayment'
]);
//AR Payment
Route::get('/arPayment',[
    'uses' => 'DashboardController@arPayment',
    'as' => 'arPayment'
]);

//EXCEL
Route::get('exportProduct/{type}', [
    'uses' => 'ExcelController@exportProduct',
    'as' => 'export.product'
]);
Route::post('importProduct', [
    'uses' => 'ExcelController@importProduct',
    'as' => 'import.product'
]);
Route::get('exportCustomer/{type}',[
    'uses' => 'ExcelController@exportCustomer',
    'as' => 'export.customer'
]);
Route::post('importCustomer', [
    'uses' => 'ExcelController@importCustomer',
    'as' => 'import.customer'
]);
Route::post('importStockBeginning', [
    'uses' => 'ExcelController@importStockBeginning',
    'as' => 'import.stockBeginning'
]);
    Route::get('cek', [
        'uses' => 'ExcelController@cek'
    ]);



//PDF
Route::get('report',[
    'uses' => 'PdfController@report',
    'as' => 'report'
]);
Route::get('neraca',[
    'uses' => 'PdfController@neraca',
    'as' => 'neraca'
]);
Route::get('labaRugi/{date}',[
   'uses' => 'PdfController@labaRugi',
   'as' => 'labaRugi'
]);

    //PDF
//    Route::get('neraca',[
//        'uses' => 'PdfController@neraca',
//        'as' => 'neraca'
//    ]);
    Route::get('jsReport/{id}',[
        'uses' => 'PdfController@jsReport',
        'as' => 'jsReport'
    ]);
    Route::get('jsReportView/{id}',[
        'uses' => 'PdfController@jsReportView',
        'as' => 'jsReportView'
    ]);
    Route::get('jsReportNeraca',[
        'uses' => 'PdfController@jsReportNeraca',
        'as' => 'jsReportNeraca'
    ]);
    Route::get('jsReportViewNeraca',[
        'uses' => 'PdfController@jsReportViewNeraca',
        'as' => 'jsReportViewNeraca'
    ]);
    Route::get('jsReportLabaRugi',[
        'uses' => 'PdfController@jsReportLabaRugi',
        'as' => 'jsReportLabaRugi'
    ]);
    Route::get('jsReportViewLabaRugi',[
        'uses' => 'PdfController@jsReportViewLabaRugi',
        'as' => 'jsReportViewNeraca'
    ]);

//Recycle
Route::get('recycle/product', [
    'uses' => 'RecycleController@product',
    'as' => 'recycle.product'
]);

//Coalist
Route::get('coalist', [
    'uses' => 'DashboardController@coaList',
    'as' => 'dashboard.coaList'
]);
Route::get('coaList/insert', [
    'uses' => 'COA\CoaListController@insert',
    'as' => 'coaList.insert'
]);
Route::get('coalist/edit/{id}', [
    'uses' => 'COA\CoaListController@edit',
    'as' => 'coaList.edit'
]);

//Coapivot
Route::get('coaPivotParent', [
    'uses' => 'DashboardController@coaPivotParent',
    'as' => 'dashboard.coaPivotParent'
]);


//CoaContol
Route::get('coaControl', [
    'uses' => 'DashboardController@coaControl',
    'as' => 'dashboard.coaControl'
]);

//CN Transaction
Route::get('cnTransaction', [
    'uses' => 'DashboardController@cnTransaction',
    'as' => 'cnTransaction'
]);
Route::get('dnTransaction', [
    'uses' => 'DashboardController@dnTransaction',
    'as' => 'dnTransaction'
]);
//CN Transaction
Route::get('creditNote', [
    'uses' => 'DashboardController@creditNote',
    'as' => 'creditNote'
]);

    //Debit Note
    Route::get('debitNote', [
        'uses' => 'DashboardController@debitNote',
        'as' => 'debitNote'
    ]);
    //Employee
    Route::get('employee', [
        'uses' => 'DashboardController@employee',
        'as' => 'employee'
    ]);
    //Report
    Route::get('jsDesign',[
        'uses'=>'DashboardController@jsDesign',
        'as'=>'jsDesign'
    ]);
    Route::get('jsReportInvoicexls',[
        'uses'=>'PdfController@jsReportInvoicexls',
        'as'=>'jsReportInvoicexls'
    ]);
    Route::get('jsDesign/preview',[
        'uses'=>'DashboardController@jsDesignPreview',
        'as'=>'jsDesign.preview'
    ]);
    //Currency
    Route::get('currency',[
        'uses'=>'DashboardController@currency',
        'as'=>'currency'
    ]);
    //Branch
    Route::get('branch',[
        'uses'=>'DashboardController@branch',
        'as'=>'branch'
    ]);
    //Coa Prodcut
    Route::get('productCoa',[
        'uses'=>'DashboardController@ProductCoa',
        'as'=>'productCoa'
    ]);

    Route::get('promotion',[
        'uses'=>'DashboardController@promotion',
        'as'=>'promotion'
    ]);
    Route::get('promotion/insert',[
        'uses'=>'Promotion\PromotionController@insert',
        'as'=>'promotion.insert'
    ]);
    Route::get('promotion/{id}',[
        'uses'=>'Promotion\PromotionController@updateData',
        'as'=>'promotion.updateData'
    ]);

    //Stock
    Route::post('stockBeginning/cekdata', [
        'uses' => 'StockBeginningController@cekdata',
        'as' => 'cekstock'
    ]);

    //Stock
    Route::get('users', [
        'uses' => 'DashboardController@users',
        'as' => 'users'
    ]);
});
