<?php
/**
 * Created by PhpStorm.
 * User: bwngrh
 * Date: 9/8/2017
 * Time: 09:55
 */

// DASHBOARD
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});
//MASTER
Breadcrumbs::register('master', function ($breadcrumbs) {
   $breadcrumbs->push('Master', route('dashboard'));
});
// PRODUCT
Breadcrumbs::register('product', function ($breadcrumbs) {
//    $breadcrumbs->parent('inventory');
    $breadcrumbs->push('Inventory / Product', route('product'));
});
Breadcrumbs::register('insert.product', function ($breadcrumbs) {
    $breadcrumbs->parent('product');
    $breadcrumbs->push('Insert Product', route('insert.product'));
});
Breadcrumbs::register('detail.product', function ($breadcrumbs) {
    $breadcrumbs->parent('product');
    $breadcrumbs->push('Detail Product', route('product.detail','id'));
});
Breadcrumbs::register('edit.product', function ($breadcrumbs) {
    $breadcrumbs->parent('product');
    $breadcrumbs->push('Edit Product', route('product.edit','id'));
});
// STOCK BEGINNING
Breadcrumbs::register('inventory', function ($breadcrumbs) {
    $breadcrumbs->push('Incentory', route('dashboard'));
});
Breadcrumbs::register('stockBeginning', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Stock Beginning', route('stock.beginning'));
});
// PRODUCT GROUP
Breadcrumbs::register('productGroup', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Product Group', route('productGroup'));
});
// PRODUCT BRAND
Breadcrumbs::register('brand', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Product Brand', route('brand'));
});
// UNIT
Breadcrumbs::register('unit', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Unit', route('unit.view'));
});
// PRODUCT UNIT
Breadcrumbs::register('unitconversion', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Unit Conversion', route('unitconversion.view'));
});
Breadcrumbs::register('insert.unitconversion', function ($breadcrumbs) {
    $breadcrumbs->parent('unitconversion');
    $breadcrumbs->push('Insert Unit Conversion', route('insert.unitconversion', 'id'));
});
Breadcrumbs::register('edit.unitconversion', function ($breadcrumbs) {
    $breadcrumbs->parent('unitconversion');
    $breadcrumbs->push('Edit Unit Conversion', route('unitconversion.editData', 'id'));
});
// TYPE
Breadcrumbs::register('productType', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Product Type', route('productType'));
});
// CATEGORY
Breadcrumbs::register('category', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Product Category', route('category'));
});
// SUB CATEGOR
Breadcrumbs::register('subCategory', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Product Sub Category', route('subCategory'));
});
//VENDOR
Breadcrumbs::register('vendors', function ($breadcrumbs){
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Vendors', route('vendors.view'));
});
Breadcrumbs::register('insert.vendors', function ($breadcrumbs){
    $breadcrumbs->parent('vendors');
    $breadcrumbs->push('Insert Vendors', route('insert.vendors'));
});
Breadcrumbs::register('edit.vendors', function ($breadcrumbs){
    $breadcrumbs->parent('vendors');
    $breadcrumbs->push('Edit Vendors', route('vendors.editData','id'));
});
// CUSTOMER GROUP
Breadcrumbs::register('customergroup', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Cuctomer Group', route('customergroup'));
});
// PRICE
Breadcrumbs::register('price', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Price', route('price'));
});
// SHIPPING METHOD
Breadcrumbs::register('delivery', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Shipping Method', route('delivery'));
});
Breadcrumbs::register('insert.delivery', function ($breadcrumbs) {
    $breadcrumbs->parent('delivery');
    $breadcrumbs->push('Insert Shipping Method', route('insert.delivery','id'));
});
Breadcrumbs::register('edit.delivery', function ($breadcrumbs) {
    $breadcrumbs->parent('delivery');
    $breadcrumbs->push('Edit Shipping Method', route('edit.delivery','id'));
});
// WAREHOUSE
Breadcrumbs::register('warehouse', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Warehouse', route('warehouse'));
});
Breadcrumbs::register('insert.warehouse', function ($breadcrumbs) {
    $breadcrumbs->parent('warehouse');
    $breadcrumbs->push('Insert Warehouse', route('warehouse.insertWarehouse'));
});
Breadcrumbs::register('edit.warehouse', function ($breadcrumbs) {
    $breadcrumbs->parent('warehouse');
    $breadcrumbs->push('Edit Warehouse', route('warehouse.updateWarehouse', 'id'));
});
// PAYMENTTERM
Breadcrumbs::register('paymentTerm', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Payment Term', route('paymentTerm'));
});
// SUPPLIER
Breadcrumbs::register('supplier', function($breadcrumbs)
{
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Vendor', route('supplier.view'));
});
Breadcrumbs::register('insert.supplier', function($breadcrumbs)
{
    $breadcrumbs->parent('supplier');
    $breadcrumbs->push('Insert Vendor', route('insert.supplier'));
});
Breadcrumbs::register('edit.supplier', function($breadcrumbs)
{
    $breadcrumbs->parent('supplier');
    $breadcrumbs->push('Edit Vendor', route('supplier.editData','id'));
});



//CUSTOMER
Breadcrumbs::register('view.customer', function ($breadcrumbs) {
    $breadcrumbs->parent('sales');
    $breadcrumbs->push('Customer', route('customer'));
});
Breadcrumbs::register('insert.customer', function ($breadcrumbs) {
    $breadcrumbs->parent('view.customer');
    $breadcrumbs->push('Insert Customer', route('insert.customer'));
});
Breadcrumbs::register('detail.customer', function ($breadcrumbs) {
    $breadcrumbs->parent('view.customer');
    $breadcrumbs->push('Detail Customer', route('detail.customer','id'));
});
Breadcrumbs::register('edit.customer', function ($breadcrumbs) {
    $breadcrumbs->parent('view.customer');
    $breadcrumbs->push('Edit Customer', route('edit.customer','id'));
});

//PURCHASE
Breadcrumbs::register('view.purchase', function ($breadcrumbs) {
    $breadcrumbs->push('Purchase', route('purchase'));
});
Breadcrumbs::register('edit.purchase', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchase');
    $breadcrumbs->push('Edit Purchase', route('edit.purchase','id'));
});
Breadcrumbs::register('detail.purchase', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchase');
    $breadcrumbs->push('Detail Purchase', route('detail.purchase', 'id'));
});
Breadcrumbs::register('insert.purchase', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchase');
    $breadcrumbs->push('Insert Purchase', route('insert.purchase'));
});

//PURCHASE ORDER
Breadcrumbs::register('view.purchaseOrder', function ($breadcrumbs) {
  $breadcrumbs->parent('purchase');
    $breadcrumbs->push('Purchase Order', route('purchaseOrder'));
});
Breadcrumbs::register('edit.purchaseOrder', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseOrder');
    $breadcrumbs->push('Edit Purchase Order', route('detail.purchaseOrder','id'));
});
Breadcrumbs::register('detail.purchaseOrder', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseOrder');
    $breadcrumbs->push('Detail Purchase Order', route('detail.purchase', 'id'));
});
Breadcrumbs::register('insert.purchaseOrder', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseOrder');
    $breadcrumbs->push('Insert Purchase Order', route('insert.purchaseOrder'));
});

//PURCHASE RETURN
Breadcrumbs::register('view.purchaseReturn', function ($breadcrumbs) {
    $breadcrumbs->push('Purchase Return', route('purchaseReturn'));
});
Breadcrumbs::register('edit.purchaseReturn', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseReturn');
    $breadcrumbs->push('Edit Purchase Return', route('edit.purchaseReturn','id'));
});
Breadcrumbs::register('detail.purchaseReturn', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseReturn');
    $breadcrumbs->push('Detail Purchase Return', route('detail.purchaseReturn', 'id'));
});
Breadcrumbs::register('insert.purchaseReturn', function ($breadcrumbs) {
    $breadcrumbs->parent('view.purchaseReturn');
    $breadcrumbs->push('Insert Purchase Return', route('insert.purchaseReturn'));
});

//AP
Breadcrumbs::register('accountPayable', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Account Payable', route('accountPayable'));
});

//AR
Breadcrumbs::register('accountReceivable', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Account Receivable', route('accountReceivable'));
});

//CREDIT NOTE TYPE
Breadcrumbs::register('creditNote.type', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Credit Note Type', route('creditNote.type'));
});

//DEBIT NOTE TYPE
Breadcrumbs::register('debitNote.type', function ($breadcrumbs) {
    $breadcrumbs->parent('master');
    $breadcrumbs->push('Debit Note Type', route('debitNote.type'));
});

//SALESMAN
Breadcrumbs::register('salesman', function ($breadcrumbs) {
    $breadcrumbs->push('Salesman', route('salesman'));
});
Breadcrumbs::register('insert.salesman', function ($breadcrumbs) {
    $breadcrumbs->parent('salesman');
    $breadcrumbs->push('Insert Salesman', route('insert.salesman'));
});
Breadcrumbs::register('detail.salesman', function ($breadcrumbs) {
    $breadcrumbs->parent('salesman');
    $breadcrumbs->push('Detail Salesman', route('detail.salesman','id'));
});
Breadcrumbs::register('edit.salesman', function ($breadcrumbs) {
    $breadcrumbs->parent('salesman');
    $breadcrumbs->push('Edit Salesman', route('edit.salesman','id'));
});

//SALE ORDER
Breadcrumbs::register('salesOrder', function ($breadcrumbs) {
  $breadcrumbs->parent('sales');
    $breadcrumbs->push('Sales Order', route('salesOrder'));
});
Breadcrumbs::register('salesOrder.insert', function ($breadcrumbs) {
    $breadcrumbs->parent('salesOrder');
    $breadcrumbs->push('Insert Sales Order', route('salesOrder.insert'));
});
Breadcrumbs::register('salesOrder.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('salesOrder');
    $breadcrumbs->push('Edit Sales Order', route('salesOrder.edit','id'));
});
Breadcrumbs::register('salesOrder.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('salesOrder');
    $breadcrumbs->push('Detail Sales Order', route('salesOrder.detail','id'));
});

//SALE TRANSACTION
Breadcrumbs::register('sales', function ($breadcrumbs) {
    $breadcrumbs->push('Sales', route('dashboard'));
});
Breadcrumbs::register('purchase', function ($breadcrumbs) {
    $breadcrumbs->push('purchase', route('dashboard'));
});
Breadcrumbs::register('salesTransaction', function ($breadcrumbs) {
    $breadcrumbs->parent('sales');
    $breadcrumbs->push('Sales Transaction', route('salesTransaction'));
});
Breadcrumbs::register('view.promotion', function ($breadcrumbs) {
    $breadcrumbs->parent('sales');
    $breadcrumbs->push('Promotion', route('promotion'));
});
Breadcrumbs::register('salesTransaction.insert', function ($breadcrumbs) {
    $breadcrumbs->parent('salesTransaction');
    $breadcrumbs->push('Create Sales Transaction', route('salesTransaction.insert'));
});
Breadcrumbs::register('salesTransaction.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('salesTransaction');
    $breadcrumbs->push('Edit Sales Transaction', route('salesTransaction.edit','id'));
});
Breadcrumbs::register('salesTransaction.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('salesTransaction');
    $breadcrumbs->push('Detail Sales Transaction', route('salesTransaction.detail','id'));
});

//SALE RETURN
Breadcrumbs::register('salesReturn', function ($breadcrumbs) {
    $breadcrumbs->parent('sales');
    $breadcrumbs->push('Sales Return', route('salesReturn'));
});
Breadcrumbs::register('salesReturn.insert', function ($breadcrumbs) {
    $breadcrumbs->parent('salesReturn');
    $breadcrumbs->push('Insert Sales Return', route('salesReturn.insertSalesReturn'));
});
Breadcrumbs::register('salesReturn.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('salesReturn');
    $breadcrumbs->push('Edit Sales Return', route('salesReturn.edit','id'));
});
Breadcrumbs::register('salesReturn.detail', function ($breadcrumbs) {
    $breadcrumbs->parent('salesReturn');
    $breadcrumbs->push('Detail Sales Return', route('salesReturn.detail','id'));
});

//AP PAYMENT
Breadcrumbs::register('apPayment', function ($breadcrumbs) {
    $breadcrumbs->push('Account Payable Payment', route('apPayment'));
});
//AR PAYMENT
Breadcrumbs::register('arPayment', function ($breadcrumbs) {
    $breadcrumbs->push('Account Receivable Payment', route('arPayment'));
});
