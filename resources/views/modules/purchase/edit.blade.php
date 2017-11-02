@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
              <a href="">{!! Breadcrumbs::render('insert.purchase') !!}</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm"
                 data-container="body"
                 data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <form action="" id="formPurchaser" method="" class="horizontal-form">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-8">
                                <span style="font-size: 24px;">Create Purchase Transaction</span>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Branch</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-search"></i></span>
                                            <input type="text" name="branch" id="branch_id" value="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row" style="margin-top:5px">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Warehouse</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="    cursor: pointer;" id="swarehouse"><i class="fa fa-search"></i></span>
                                            <input type="text"  value="{{$purchase->warehouse->code." ".$purchase->warehouse->name}}" id="twerehouse" class="form-control">
                                            <input type="hidden" value="{{$purchase->warehouse_id}}" name="werehouse_id" id="werehouse" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"><hr></div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Transaction No</label>
                                    <div class="col-md-8">
                                        <div class="input-group" style="width:100%">
                                            <input type="text" name="purchase_no" value="{{$purchase->purchase_transaction_no}}" readonly  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-4">
                                <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Date</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="date" required name="date" value="{{date('Y/m/d')}}" class="form-control date" placeholder="-">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                <div class="form-group">
                                    <label class="control-label  col-md-4">Vendor</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="    cursor: pointer;" id="scustomer"><i class="fa fa-search"></i></span>
                                            <input type="text" id="customer" required name="" value="" class="form-control" placeholder="-">
                                            <input type="hidden" id="customer_id" required name="customer_id" value="" class="form-control" placeholder="-">
                                            <input type="hidden" id="customer_group_id" required name="customer_group_id" value="" class="form-control" placeholder="-">

                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4">Term of Payment</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="    cursor: pointer;" id="stermof"><i class="fa fa-search"></i></span>
                                                <input type="hidden" id="term_of_payment_id" required name="term_of_payment_id" value="" class="form-control" placeholder="-">
                                                <input type="text" id="term_of_payment" required name="" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4">Delivery Type</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="    cursor: pointer;" id="sDt"><i class="fa fa-search"></i></span>
                                                <input type="hidden" id="delivery_type_id" required name="delivery_type_id" value="" class="form-control" placeholder="-">
                                                <input type="text" id="delivery_type" required name="" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4">Currency</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="    cursor: pointer;" id="scurrency"><i class="fa fa-search"></i></span>
                                                <input type="text" id="currency" required class="form-control" placeholder="-">
                                                <input type="hidden" id="currency_id" required name="currency_id" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4">Purchase Order No</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="    cursor: pointer;" id="sso"><i class="fa fa-search"></i></span>
                                                <input type="hidden" id="purchaseOrderId" required name="sales_order_id" value="" class="form-control" placeholder="-">
                                                <input type="text" id="sales_order_id" required name="" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4"></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="checkbox" id="ctax"> Tax
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label">Vendor No</label>
                                        <input type="text" name="vendor_no" class="form-control" value="" id="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true">Product Detail</a>
                    </li>
                </ul>
                <div class="tab-content" style="    border: #ccc solid 1px;    padding-top: 5px;">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <button type="button" class="btn btn-default btn-circle btn-sm addplusProd">
                                        <i class="fa fa-plus"></i> Add </button>
                                </div>
                                <div class="actions">
                                    <input id="includetax" disabled type="checkbox">Include tax
                                </div>
                            </div>
                            <div class="portlet-body form"  style="    max-height: 200px;
    overflow-y: scroll;
    min-height: 200px;">
                                <table class="table table-hover table-bordered" id="tabledetail">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item No</th>
                                        <th>Product Code</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Basic Unit</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot style="display: none;">
                                    <tr>
                                        <td colspan="7" style="text-align: right">Sub Total </td>
                                        <td><span id="sumtotal"></span></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box">
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                    <label class="control-label">Remarks</label>
                                    <textarea class="form-control" name="remarks"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><strong>Subtotal before tax</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="hidden" name="subtotal_before_tax" id="subtotal_before_tax" class="form-control">
                                                    <input type="text" id="lsubtotal_before_tax" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><strong>Tax</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="hidden" name="tax" id="ttax" class="form-control">
                                                    <input type="text" readonly id="lttax" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><strong>Subtotal after tax</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="hidden" name="subtotal_after_tax" id="subtotal_after_tax" class="form-control">
                                                    <input type="text" id="lsubtotal_after_tax" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Additional Discount</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" name="otherdiscount" id="otherdiscount" value="0.00" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Additional Cost</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" name="othercost" id="othercost" value="0.00" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><strong>GrandTotal</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="hidden" name="grandtotal" id="grandtotal" class="form-control">
                                                    <input type="text" id="lgrandtotal" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <input type="hidden" required name="totalsum"  id="tsumtotal" value="" class="form-control">
                            <input type="hidden" required name="totalsumtax"  id="tsumtotaltax" value="0" class="form-control">
                            <input type="hidden" required name="tsumqty"  id="tsumqty" value="0" class="form-control">
                        </div>

                    </div>
                    <div class="form-actions center">
                        <center>
                        <button type="button" class="btn green btnSaveProduct">
                            <i class="fa fa-check"></i> Create</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="detailpurchaseorder" aria-labelledby="myModalLabel"  role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg cascading-modal" rule="document">
            <div class="modal-content" style="z-index: 2000;">
                <div class="modal-header light-blue darken-3 white-text">
                    <h4 class="title"><i class="fa fa-pencil"></i>Product Detail</h4>
                    <span>
                        JK01/MJM
                    </span>
                </div>
                <div class="modal-body" data-backdrop="false">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Product Code</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <input name="product_id" type="hidden"  style="width: 100%"  id="product_id" class="form-control">
                                    <span class="input-group-addon"  id="sproduct" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="productids" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Item No</label>
                                <div class="col-sm-8">
                                    <input name=""  readonly style="width: 100%"  id="item_no"class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-4">Product Name</label>
                                <div class="col-sm-8">
                                    <input name="" readonly  style="width: 100%"  id="product_name"class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <table class="table table-bordered">
                                <tr>
                                    <td width="50%">
                                        <div class="row">
                                           <div class="col-sm-12">
                                             <div class="form-group">
                                                 <label class="control-label col-sm-1">Qty</label>
                                                 <div class="col-sm-3">
                                                     <input type="text" id="qty" class="form-control">
                                                     <input type="hidden" id="qtykali" class="form-control">
                                                 </div>
                                                 <div class="col-sm-4">
                                                     <div class="input-group">
                                                         <span class="input-group-addon" id="sunit" ><i class="fa fa-search"></i></span>
                                                         <input type="hidden" id="unit_id" class="form-control">
                                                          <input type="text" id="unit" class="form-control">
                                                     </div>
                                                 </div>
                                                 <div class="col-sm-4">
                                                     <input type="text" readonly id="totqty" class="form-control">
                                                 </div>
                                             </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Price</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" id="lprice" readonly class="form-control">
                                                        <input type="hidden" id="price" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                          <input type="hidden" id="totdiscount">
                                          <input type="hidden" id="list_disc">
                                          <input type="hidden" id="list_disc_reg">
                                          <input type="hidden" id="list_disc_pro">
                                          <input type="hidden" id="list_disc_pro2">
                                          <input type="hidden" id="totdiscreg">
                                            <div id="login" style="display:none;    width: 22%;
    margin-left: auto;
    margin-right: auto;">
                                                <img src="{{ asset('img/slider-loading.gif') }}" >
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Total Price</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" id="" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="hidden" id="totalprice" class="form-control">
                                                        <input type="text" readonly id="ltotalprice" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Tax</label>
                                                    <div class="col-sm-4">
                                                      <input type="hidden" id="tax_id" name="tax_id" rate="10" value="1" class="form-control">
                                                        <input type="text" id="tax" rate="10" value="PPN" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Salesman</label>
                                                    <div class="col-sm-4">
                                                        <input id="salesmans" name="" type="text" value="INDRA" class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Stock available</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <table class="table table-bordered" id="table-stock">
                                                        <thead>
                                                            <tr>
                                                                <th>Qty</th>
                                                                <th>Unit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Unit Convertion</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <table class="table table-hover table-bordered" id="table-unitcon">
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-circle green btnall center-block" >Add</button>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function(){
          $(".date").datepicker({
            dateFormat:'yy/mm/dd'
          });
          var trdiscountReg="";
            function getTotalPrice(){
              var unit = $("#unit_id").val();
              var qty = $("#qty").val();
              var kaliQty=$("#qtykali").val();
              var price = $("#price").val();
              totalqty = qty*kaliQty;
              var total_price = parseFloat(totalqty*price).toFixed(2)
              $("#totalprice").val(total_price)
              $("#qtykali").val(kaliQty);
              hitungdiscount(total_price);

              $.ajax( {
                  url: "{{url('api/product/cekStock')}}/"+$("#product_id").val(),
                  dataType: "json",
                  data: {
                      branch_id: $('#branch_id').val(),
                      qtys:totalqty
                  },
                  success: function( data ) {
                      //console.log(data.status)
                      if(data.status==0){
                          $("#tablediscount tbody").empty();
                          $("#detailpurchaseorder").modal('hide')
                          $("#totqty").val(parseFloat((parseFloat(data.stock/kaliQty).toFixed(0))*kaliQty).toFixed(0)+" PCS")
                          $("#qty").val(parseFloat(data.stock/kaliQty).toFixed(0)).trigger('change')
                          swal({
                              title: "Stock",
                              text: data.msg,
                              type: "info",
                              confirmButtonClass: "btn-primary"
                          },function(){
                            $("#detailpurchaseorder").modal()
                          }
                        )
                      }else{
                        $("#totqty").val(totalqty+" PCS").trigger('change')
                      }
                  }
              });
            }
            $("#unit").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/product/getUnit')}}",
                        dataType: "json",
                        data: {
                            prod_id:$("#product_id").val()
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {
                                return {
                                    value: value.name,
                                    id:value.id,
                                    qty:value.qty,
                                    unit_id:value.unit_id
                                };
                            }));
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#unit" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit_id').val(ui.item.unit_id).trigger('change')
                $('#qtykali').val(ui.item.qty).trigger('change')
                //alert(ui.item.qty)
                $('#qty').val($('#qty').val()).trigger('change')
                //alert('aaaaa')
            })
            $( "#sunit" ).click(function(){
                $('#unit').val('').focus()
            })
            $("#salesman").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/salesman/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {

                                return {
                                    label:value.first_name+" "+value.last_name,
                                    value: value.code+" "+value.first_name+" "+value.last_name ,
                                    id:value.id
                                };
                            }));
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#salesman" ).on( "autocompleteselect", function( event, ui ) {
                $('#salesman_id').val(ui.item.id).trigger('change')
            })
            $( "#ssalesman" ).click(function(){
                $('#salesman').val('').focus()
            })
            $("#productids").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/product/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term,
                            branch_id:$('#branch_id').val(),
                            customer_group_id:$('#customer_group_id').val()
                        },
                        success: function( data ) {
                            response($.map(data.data, function (value, key) {
                                console.log(value)
                                return {
                                    label: value.code+"-"+value.item_no,
                                    value: value.code,
                                    id:value.id,
                                    item:value.item_no,
                                    name:value.name,
                                    price:value.selling_price,
                                    unit:value.unit_name,
                                    unit_id:value.unit_id,
                                    disc1:value.reg_disc_1,
                                    disc2:value.reg_disc_2,
                                    qtykali:value.qtykali
                                };
                            }));
                        },
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#customer").autocomplete({
                source:function(request,response){
                    $.ajax( {
                      url: "{{url('api/vendor/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term,
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {
                                console.log(value.code)
                                return {
                                    label: value.code+"-"+value.name,
                                    value: value.code,
                                    id:value.id,
                                    customer_group_id:value.customer_group_id
                                };
                            }));
                        },
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#term_of_payment").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/paymentTerm/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {
                                return {
                                    label: value.remarks,
                                    value: value.remarks,
                                    id:value.id
                                };
                            }));
                        },
                        select:function(event, ui){
                            console.log(ui.item.label)
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#tax").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/tax/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {
                                return {
                                    label: value.name,
                                    value: value.name,
                                    id:value.id,
                                    rate:value.rate
                                };
                            }));
                        },
                        select:function(event, ui){
                            console.log(ui.item.label)
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#delivery_type").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/delivery/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {

                                return {
                                    label: value.code+" "+value.name,
                                    value: value.code,
                                    id:value.id
                                };
                            }));
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#currency").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        url: "{{url('api/currency/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {

                                return {
                                    label: value.name+" "+value.symbol,
                                    value: value.symbol,
                                    id:value.id
                                };
                            }));
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $("#sales_order_id").autocomplete({
                source:function(request,response){
                    $.ajax( {
                        //url: "{{url('api/salesOrder/getAllData')}}",
                        url: "{{url('api/purchaseOrder/getAllData')}}",
                        dataType: "json",
                        data: {
                            code: request.term
                        },
                        success: function( data ) {
                            response($.map(data.msg, function (value, key) {

                                return {
                                    label: value.purchase_order_no+"-"+accounting.formatMoney(value.grand_total_w_tax,'',2),
                                    value:value.purchase_order_no,
                                    id:value.id
                                };
                            }));
                        }
                    });
                },minLength:0
            }).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#sales_order_id" ).on( "autocompleteselect", function( event, ui ) {
                $('#purchaseOrderId').val(ui.item.id).trigger('change')
            })
            $( "#customer" ).on( "autocompleteselect", function( event, ui ) {
                $('#customer_id').val(ui.item.id).trigger('change')
                $('#customer_group_id').val(ui.item.customer_group_id).trigger('change')
            })
            $( "#unit" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit_id').val(ui.item.id).trigger('change')
            })
            $( "#tax" ).on( "autocompleteselect", function( event, ui ) {
                $('#tax_id').attr('rate',ui.item.id)
                $('#tax_id').val(ui.item.id).trigger('change')
            })
            $( "#term_of_payment" ).on( "autocompleteselect", function( event, ui ) {
                $('#term_of_payment_id').val(ui.item.id).trigger('change')
            })
            $( "#delivery_type" ).on( "autocompleteselect", function( event, ui ) {
                $('#delivery_type_id').val(ui.item.id).trigger('change')
            })
            $( "#currency" ).on( "autocompleteselect", function( event, ui ) {
                $('#currency_id').val(ui.item.id).trigger('change')
            })
            $( "#twerehouse" ).on( "autocompleteselect", function( event, ui ) {
                $('#werehouse').val(ui.item.id).trigger('change')
            })
            $("#product_id").on('change',function(){
              $.ajax( {
                  url: "{{url('api/product/getUnitPerProd')}}/"+$(this).val(),
                  type: "get",
                  data: {
                      branch_id:$("#branch_id").val()
                  },success:function(data){
                      $('#table-stock tbody').empty();
                      $('#table-unitcon tbody').empty();
                      trstock="";
                      trunitcon=""
                      $.each(data.msg,function(key,value){
                          trstock += "<tr><td>"+value.unit+"</td><td>"+value.unit_name+"</td></tr>";
                          trunitcon += "<tr><td>"+value.unit_name+"</td><td>=</td><td>"+value.qty+"</td><td>PCS</td></tr>";
                      })
                      console.log(trunitcon)
                      $('#table-unitcon tbody').append(trunitcon);
                      $('#table-stock tbody').append(trstock);

                  }
                })
            })
            $( "#productids" ).on( "autocompleteselect", function( event, ui ) {
                $("#product_name").val(ui.item.name)
                $("#item_no").val(ui.item.item)
                $("#price").val(ui.item.price)
                $("#lprice").val(accounting.formatMoney(ui.item.price, '', 2))
                $('#product_id').val(ui.item.id).trigger('change')
                $('#unit').val(ui.item.unit).trigger('change')
                $('#qtykali').val(ui.item.qtykali).trigger('change')
                $('#qty').val(1).trigger('change')
                $('#unit_id').val(ui.item.unit_id).trigger('change');
                trdiscountReg="";
                if(ui.item.disc1!='0.00'){
                  trdiscountReg += "<tr><td>#</td><td><input class='tdiscount_reg'  type='hidden' value='"+ui.item.disc1+"'>"+ui.item.disc1+"</td><td><input class='tdiscount_reg' disc='2' type='hidden' value='"+ui.item.disc2+"'>"+ui.item.disc2+"</td><td>Reg disc</td></tr>";
                }
            })
            $('#qty').change(function () {
                getTotalPrice()
                $("#tablediscount tbody").empty();
            })
            $("#totqty").change(function(){
              $("#tablediscount tbody").empty();
              $('#login').show();
              $.ajax( {
                  url: "{{url('api/promotion/cekPromotion')}}",
                  type: "get",
                  data: {
                      prodid:$("#product_id").val(),
                      qty:$(this).val().split(" ")[0],
                      custid:$("#customer_id").val(),
                      unitid:$("#unit_id").val()
                  },success:function(data){
                      var trtable = "";
                      trtable +=trdiscountReg
                      $.each(data.msg,function(index,value){
                          trtable += "<tr><td>#</td><td><input disc='1' class='tdiscount' type='hidden' value='"+value.disc+"'>"+value.disc+"</td><td><input class='tdiscount' disc='2' type='hidden' value='"+value.disc2+"'>"+value.disc2+"</td><td>"+value.desc+"</td></tr>";
                      })
                      $("#tablediscount tbody").append(trtable);
                      $('#login').hide();
                      hitungdiscount($("#totalprice").val())
                  }
                })
            })
            $("#swarehouse").click(function () {
                $('#twerehouse').val('').trigger('focus');
            })
            $("#sproduct").click(function () {
                $('#productids').val('').trigger('focus');
            })
            $("#scustomer").click(function () {
                $('#customer').val('').trigger('focus');
            })
            $("#stermof").click(function () {
                $('#term_of_payment').val('').trigger('focus');
            })
            $("#sDt").click(function () {
                $('#delivery_type').val('').trigger('focus');
            })
            $("#scurrency").click(function () {
                $('#currency').val('').trigger('focus');
            })
            $("#sproduct").click(function () {
                $('#productids').val('').trigger('focus');
            })
            $("#sso").click(function () {
                $('#sales_order_id').val('').trigger('focus');
            })

            $( "#twerehouse" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/werehouse/getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label: value.code+""+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            function grandtotal(){
                var subtotal = $('#subtotal_after_tax').val();
                var otherdiscount = $('#otherdiscount').val();
                var othercost = $('#othercost').val();
                $("#grandtotal").val(parseFloat(parseFloat(subtotal)-parseFloat(otherdiscount) + parseFloat(othercost)).toFixed(2));
                $("#lgrandtotal").val(accounting.formatMoney(parseFloat(subtotal)-parseFloat(otherdiscount) + parseFloat(othercost),'',2));
            }
            $(document).on("keyup", '#otherdiscount',function(){
                grandtotal()
            })
            $(document).on("keyup", '#othercost',function(){
                grandtotal()
            })
            $(document).on("change", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
                $('.unit').empty();
                $('.unit').append('<option value="">---</option>');
                var id =datalist.attr('id');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.unit')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })
            $('#includetax').click(function() {
                hitung()
            });
            $('#ctax').click(function() {
                if($(this).is(":checked")){
                  document.getElementById('includetax').checked=false
                  document.getElementById('includetax').disabled=false;
                  hitung()
                }else{
                  document.getElementById('includetax').checked=false
                  document.getElementById('includetax').disabled=true;
                  hitung()
                }
              }
            );
            $(document).on("click", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
                var id =datalist.attr('id');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.unit')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })

            $(".addplusProd").click(function(){
                $('.datalistp').val()
                $("#detailpurchaseorder").modal();
                $(".btnall").html("<i class ='icon-plus'></i> Add")
                $("#qty").val(0)
                $("#lprice").val('')
                $("#price").val('')
                $("#totalprice").val('')
                $("#ltotalprice").val('')
                $("#productids").val('')
                $("#product_id").val('')
                $("#product_name").val('')
                $("#unit").val('')
                $("#item_no").val('')
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                $(".btnall").addClass('btnAddProduct')
                $(".btnall").removeClass('btneditProduct')
            })
            $(".shippingDate").datepicker(
                {
                    autoclose:true,
                    format: 'yyyy/mm/dd'
                }
            )
            $(".select2").select2()

            $("#qty").change(function(){
                total = $('#price').val()*$(this).val()
                $("#total").val(total)
            })
            $("#discount").change(function(){
                total = $('#price').val()*$('#qty').val()
                $("#total").val(total- $(this).val())
            })
            $("#pdiscount").change(function(){
                total = $('#price').val()*$('#qty').val()-$('#discount').val()
                pdiscount = (total * $(this).val())/100
                $("#total").val(total- pdiscount)
            })
            var sumtotal=0;
            $(document).on("click", '.editPurchseOrder',function(){
                $(".btnall").removeAttr('index')
                var index = $(this).attr('data-index')
                $(".btnall").attr('index',index)
                $(".btnall").html("<i class ='icon-check'></i> Update")
                var id = $(this).attr('data-id')
                var value = $(this).attr('data-value')
                var price = $(this).attr('data-price')
                var qtykali = $(this).attr('data-qtykali')
                var name = $(this).attr('data-name')
                var unitname = $(this).attr('data-unitname')
                var unitid = $(this).attr('data-unitid')
                var qty = $(this).attr('data-qty')
                var disc = $(this).attr('data-disc')
                var disc2 = $(this).attr('data-disc2')
                var item_no = $(this).attr('data-item_no')
                var code = $(this).attr('data-code')
                var discount = $(this).attr('data-discount')
                var total = $(this).attr('data-total')
                trdiscountReg="";
                if(disc!='0.00'){
                  trdiscountReg += "<tr><td>#</td><td><input class='tdiscount_reg'  type='hidden' value='"+disc+"'>"+disc+"</td><td><input class='tdiscount_reg' disc='2' type='hidden' value='"+disc2+"'>"+disc2+"</td><td>Reg disc</td></tr>";
                }
                $("#product_id").val(id).trigger('change')
                //alert(unitid)
                $("#unit").val(unitname);
                $("#unit_id").val(unitid);
                $("#qtykali").val(qtykali);
                $("#qty").val(qty).trigger('change');
                $("#price").val(price);
                $("#lprice").val(accounting.formatMoney(price,'',2));
                $("#discount").val(discount);
                $("#totalprice").val(total);
                $("#product_name").val(name);
                $("#item_no").val(item_no);
                $("#ltotalprice").val(accounting.formatMoney(total,'',2));
                $("#detailpurchaseorder").modal();

                $("#productids").val(code);

                $(".btnall").removeClass('btnAddProduct')
                $(".btnall").addClass('btneditProduct')

            })
            $(document).on("click", '.btneditProduct',function(){
                totqty = $('#totqty').val().split(" ");
                $('#lconversion_'+$(this).attr('index')).html(totqty[0]);
                $("#qty_"+$(this).attr('index')).val($("#qty").val());
                $("#unit_"+$(this).attr('index')).val($("#unit_id").val());
                $("#lunit_"+$(this).attr('index')).html($("#unit").val());
                $("#lqty_"+$(this).attr('index')).html($("#qty").val());
                $("#list_disc_"+$(this).attr('index')).val($("#list_disc").val());
                $("#list_disc_pro_"+$(this).attr('index')).val($("#list_disc_pro").val());
                $("#list_disc_pro2_"+$(this).attr('index')).val($("#list_disc_pro2").val());
                $("#list_disc_reg_"+$(this).attr('index')).val($("#list_disc_reg").val());
                $("#product_"+$(this).attr('index')).val($("#product_id").val());
                $("#lproduct_"+$(this).attr('index')).val($("#product_name").val());
                $("#lproduct_code_"+$(this).attr('index')).html($("#productids").val());
                $("#price_"+$(this).attr('index')).val($("#price").val());
                $("#lprice_"+$(this).attr('index')).html(accounting.formatMoney($("#totalprice").val(),'',2));
                $("#discount_"+$(this).attr('index')).val($("#totdiscount").val());
                $("#ltotdiscount_"+$(this).attr('index')).html(accounting.formatMoney($("#totdiscount").val(),'',2));
                $("#pdiscount_"+$(this).attr('index')).val($("#pdiscount").val());
                totalprice = parseFloat($("#totalprice").val()) - parseFloat($("#totdiscount").val());
                $("#total_"+$(this).attr('index')).val(totalprice);
                $("#total_"+$(this).attr('index')).attr('price',totalprice);
                $("#ltotal_"+$(this).attr('index')).html(accounting.formatMoney(totalprice,'',2));
                $("#detailpurchaseorder").modal('hide');
                $("#editPurchseOrder_"+$(this).attr('index')).attr('data-qty',$("#qty").val())
                $("#editPurchseOrder_"+$(this).attr('index')).attr('data-unitid',$("#unit_id").val())
                $("#editPurchseOrder_"+$(this).attr('index')).attr('data-unitname',$("#unit").val())
                hitung()
            })
            $(document).on("click", '.btnAddProduct',function(){
                if($("#productid").val()==0){
                    swal("Product Can't Empty")
                    exit;
                }
                var totalprice,qqty,qtykali,pricedasar;
                qqty = $("#qty").val()
                qtykali = $("#qtykali").val()
                pricedasar = $("#price").val()
                totalprice = parseFloat((qqty*qtykali)*pricedasar).toFixed(2);
                totalwithdiscount = totalprice;
                totalprice -= $("#totdiscount").val()

                var rate = $("#tax_id").attr('rate')
                $("#detailpurchaseorder").modal('hide');
                var count = $('#tabledetail tbody tr').length;
                var table = document.getElementById("tabledetail").getElementsByTagName('tbody')[0];
                var row = table.insertRow(count)
                var no = row.insertCell(0)
                var item_no = row.insertCell(1)
                var product_code = row.insertCell(2)
                var productName = row.insertCell(3)
                var qty = row.insertCell(4)
                var unit = row.insertCell(5)
                var bunit = row.insertCell(6)
                var price = row.insertCell(7)
                var discount = row.insertCell(8)
                var total = row.insertCell(9)
                var action = row.insertCell(10)
                var disc_reg = $("#list_disc_reg").val();
                var ar_disc_reg = disc_reg.split(',');
                var actions ="<button type='button'" +
                    "data-id='" + $("#product_id").val() + "'" +
                    "data-value='" + $("#product_id").val() + "'" +
                    "data-code='"+$("#productids").val()+"'"+
                    "data-item_no='"+$("#item_no").val()+"'"+
                    "data-unitid='" + $("#unit_id").val() + "'" +
                    "data-unitname='" + $("#unit").val() + "'" +
                    "data-index='" + count + "'" +
                    "data-price='" + $("#price").val() + "'" +
                    "data-name='" + $("#product_name").val() + "'" +
                    "data-disc='"+ar_disc_reg[0]+"'"+
                    "data-disc2='"+ar_disc_reg[1]+"'"+
                    "data-qty='" + $("#unit_qty").val() + "'" +
                    "data-qtykali='" + $("#qtykali").val() + "'" +
                    "data-discount='" + $("#totdiscount").val() + "'" +
                    "data-total='" + totalwithdiscount + "'" +
                    "class='btn btn-info editPurchseOrder' id='editPurchseOrder_"+count+"' ><i class='icon-note'></i></button>" +
                    "<button type='button' data-index='"+count+"' class='btn btn-danger delete'><i class='icon-trash'></i></button>";
                no.innerHTML=count+1
                bunit.innerHTML="<span id='lconversion_"+count+"'>"+$("#totqty").val().split(" ")[0]+"</span>"
                item_no.innerHTML = "<span id='litemno_"+count+"'>"+$("#item_no").val()+"</span>"
                product_code.innerHTML = "<span id='lproduct_code_"+count+"'>"+$("#productids").val()+"</span>"
                productName.innerHTML = "<input type='hidden' id='product_"+count+"' name='productid[]' value='"+$("#product_id").val()+"'><span id='lproduct_"+count+"'>"+$("#product_name").val()+"</span>"
                qty.innerHTML = "<input type='hidden' id='qty_"+count+"' name='qty[]' value='"+$("#qty").val()+"'><span id='lqty_"+count+"'>"+$("#qty").val()+"</span>"
                unit.innerHTML = "<input type='hidden' id='list_disc_"+count+"' name='list_disc[]' value='"+$("#list_disc").val()+"'><input type='hidden' id='unit_"+count+"' name='unit[]' value='"+$("#unit_id").val()+"'><span id='lunit_"+count+"'>"+$("#unit").val()+"</span>"
                price.innerHTML = "<input type='hidden' id='list_disc_reg_"+count+"' name='list_disc_reg[]' value='"+$("#list_disc_reg").val()+"'><input type='hidden' id='list_disc_pro_"+count+"' name='list_disc_pro2[]' value='"+$("#list_disc_pro2").val()+"'><input type='hidden' id='list_disc_pro_"+count+"' name='list_disc_pro[]' value='"+$("#list_disc_pro").val()+"'><input type='hidden' id='price_"+count+"' name='price[]' value='"+$("#price").val()+"'><span id='lprice_"+count+"'>"+accounting.formatMoney($("#totalprice").val(),'',2)+"</span>"
                discount.innerHTML = "<input type='hidden' id='totdiscreg_"+count+"' name='totdisc_reg[]' value='"+$("#totdiscreg").val()+"'><input type='hidden' id='discount_"+count+"' name='discount[]' value='"+$("#totdiscount").val()+"'><span id='ltotdiscount_"+count+"'>"+accounting.formatMoney($("#totdiscount").val(),'',2)+"</span>"
                total.innerHTML = "<input type='hidden'  id='rate_"+count+"' name='rate[]' value='"+rate+"'><input type='hidden'  id='tax_"+count+"' name='taxid[]' value='"+$('#tax_id').val()+"'><input type='hidden'  id='total_"+count+"' qty='"+qqty+"' price_dasar='"+pricedasar+"'  qtykali='"+qtykali+"'  price='"+totalprice+"' class='total' name='total[]' value='"+totalprice+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney(totalprice,'Rp ',2)+"</span>"
                action.innerHTML = actions
                hitung()
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)

            })
            $(document).on("click", '.delete',function(){
                rowindex = $(this).parents("tr").index();
                swal({
                    title: "Delete?",
                    text: "Data will be deleted?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary",
                    closeOnConfirm: true
                }, function (isConfirm) {
                    if(isConfirm) {
                        document.getElementById("tabledetail").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                        hitung()
                    }
                })
            })
            var form = $('#formPurchaser');
            $('#formPurchaser').validate();
            $(".btnSaveProduct").click(function(){
                var urls='{{route('purchase.addData')}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formPurchaser').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            //console.log(data)
                            //alert(data.msg);
                            //location.reload();
                            //exit;
                            swal({
                                    title: "Purchase",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        location.href = '{{url('purchase')}}'
                                    }
                                })
                            )
                        }
                    });}
            })
            $("#purchaseOrderId").change(function(){
                $("#tabledetail tbody").empty();
                id = $("#purchaseOrderId").val()
                var count = $('#tabledetail tbody tr').length;
                var valuetable =""
                $.get('{{url('api/purchaseOrder/getDetail/')}}/'+id,function(data){
                    console.log(data);
                    var data = data.msg;
                    var n =1;
                    for(var i in data)
                    {
                       price = (data[i].unit_qty*data[i].qtykali)*data[i].price;
                       price_total = price;
                       reguler_discount = 0;
                       disc1 = 0;
                       price_total -= disc1;
                       disc2 = 0;
                       reguler_discount = disc1+disc2;
                       price_total -= disc2;
                      //  var price_disc = data[i].price_disc.split(',');
                      //  var promo_disc1 = data[i].promo_disc1.split(',');
                      //  var promo_disc2 = data[i].promo_disc2.split(',');
                      //  promo_disc=0;
                      //  $.each(price_disc,function(key,value){
                      //    promo_disc += price_total*(promo_disc1[key]/100);
                      //     price_total -= price_total*(promo_disc1[key]/100);
                      //     promo_disc += price_total*(promo_disc2[key]/100);
                      //     price_total -= price_total*(promo_disc2[key]/100);
                      //  })
                       //total_discount = reguler_discount+promo_disc;
                      total_discount=0;
                       valuetable = valuetable+"<tr>" +
                            "<td>"+ parseInt(n)+"</td>"+
                            "<td><span id='litemno_"+n+"'>"+ data[i].item_no+"</span></td>"+
                            "<td><span id='lproduct_code_"+n+"'>"+ data[i].code+"</span>"+
                            "<td><input type='hidden' id='product_"+count+"' name='productid[]' value='"+data[i].id+"'><span id='lproduct_"+count+"'>"+data[i].name+"</span></td>"+
                            "<td><input type='hidden' id='qty_"+count+"' class='qty' name='qty[]' value='"+data[i].qty+"'><span id='lqty_"+count+"'>"+data[i].unit_qty+"</span></td>"+
                            "<td><input type='hidden' id='list_disc_"+count+"' name='list_disc[]' value='0'><input type='hidden' id='unit_"+count+"' name='unit[]' value='"+data[i].unit_id+"'><span id='lunit_"+count+"'>"+data[i].unitname+"</span></td>"+
                            "<td><span id='lconversion_"+count+"'>"+data[i].qty+"</span></td>"+
                            "<td><input type='hidden' id='list_disc_reg_"+count+"' name='list_disc_reg[]' value='"+data[i].disc1+","+data[i].disc2+",'><input type='hidden' id='list_disc_pro2_"+count+"' name='list_disc_pro2[]' value='"+data[i].promo_disc2+",'><input type='hidden' id='list_disc_pro_"+count+"' name='list_disc_pro[]' value='"+data[i].promo_disc1+",'><input type='hidden' id='price_"+count+"' name='price[]' value='"+parseInt(data[i].price)+"'><span id='lprice_"+count+"'>"+accounting.formatMoney(price,'',2)+"</span></td>"+
                            "<td><input type='hidden' id='totdiscreg_"+count+"' name='totdisc_reg[]' value='"+reguler_discount+"'><input type='hidden' id='discount_"+count+"' name='discount[]' value='"+total_discount+"'><span id='ltotdiscount_"+count+"'>"+accounting.formatMoney(total_discount,'',2)+"</span></td>"+
                            "<td><input type='hidden'  id='rate_"+count+"' name='rate[]' value='10'><input type='hidden'  id='tax_"+count+"' name='taxid[]' value='"+data[i].tax_id+"'><input type='hidden' id='total_"+count+"' class='total' price='"+parseInt(price_total)+"' name='total[]' value='"+parseInt(price_total)+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney(price_total,'',2)+"</span></td>"+
                            "<td><button type='button'" +
                            "data-index='"+count+"'"+
                            "data-id='" + data[i].product_id + "'" +
                            "data-code='"+data[i].code+"'"+
                            "data-unitid='" + data[i].unit_id + "'" +
                            "data-unitname='" + data[i].unitname + "'" +
                            "data-name='"+data[i].name + "'" +
                            "data-price='" + data[i].price + "'" +
                              "data-disc='" + data[i].disc1 + "'" +
                                "data-disc2='" + data[i].disc2 + "'" +
                            "data-qty='" + data[i].unit_qty + "'" +
                            "data-qtykali='" + data[i].qtykali + "'" +
                            "data-item_no='" + data[i].item_no + "'" +
                            "data-discount='" + price_total + "'" +
                            "data-total='" + parseInt(price) + "'" +
                            "class='btn btn-info editPurchseOrder' id='editPurchseOrder_"+count+"' ><i class='icon-note'></i></button>" +
                            " <button data-index='"+count+"' data-id ='" + data[i].id + "' type='button' class='btn btn-danger delete'><i class='icon-trash'></i></button>"+ "</td></tr>"+
                            n++;
                        count++;
                    }
                    $("#tabledetail tbody").append(valuetable)
                    //console.log(valuetable)
                    hitung()
                })
            })
            function hitungdiscount(total){
              var total_discount,total_discount2,total_before_discount,disreg,list_disc_reg,list_disc_pro,list_disc_pro2,totdiscperrule;
              total_before_discount=total;
              total_discount=0;
              total_discount2=0;
              disreg = 0;
              list_disc="";
              list_disc_reg="";
              list_disc_pro="";
              list_disc_pro2="";
              $('.tdiscount_reg').each(function(){
                    list_disc_reg += $(this).val()+",";
                    total_discount += parseFloat($(this).val()/100)*parseFloat(total_before_discount)
                    disreg += parseFloat($(this).val()/100)*parseFloat(total_before_discount)
                    total_before_discount -= parseFloat($(this).val()/100)*parseFloat(total_before_discount);
              });
              $('.tdiscount').each(function(){
                if($(this).attr('disc')==1){
                  list_disc_pro += $(this).val()+",";
                  total_discount2 += parseFloat($(this).val()/100)*parseFloat(total_before_discount)
                }else{
                  list_disc_pro2 += $(this).val()+",";
                  total_discount2 += parseFloat($(this).val()/100)*parseFloat(total_before_discount)
                  list_disc += total_discount2+",";
                  total_discount2=0;
                }
                    total_discount += parseFloat($(this).val()/100)*parseFloat(total_before_discount)
                    total_before_discount -= parseFloat($(this).val()/100)*parseFloat(total_before_discount);

              });
              $("#totdiscount").val(total_discount)
              $("#totdiscreg").val(disreg)
              $("#list_disc_reg").val(list_disc_reg)
              $("#list_disc").val(list_disc)
              $("#list_disc_pro").val(list_disc_pro)
              $("#list_disc_pro2").val(list_disc_pro2)
              $("#ltotalprice").val(accounting.formatMoney(total_before_discount,'',2))
            }
            function hitung() {
                var sum = 0;
                var pajak=0;
                var selisihpajak=0;
                var sumqty = 0;
                var sumtax = 0;
                var sumttax = 0;
                $('.total').each(function () {
                    sum += parseFloat($(this).attr('price'));
                });
                $('.qty').each(function () {
                    sumqty += parseFloat($(this).val());
                });
                $('.ttax').each(function () {
                    sumtax += parseFloat($(this).attr('price'));
                });
                $('.totaltax').each(function () {
                    sumttax += parseFloat($(this).attr('price'));
                });
                $("#tsumtotal").val(sum).trigger('change');
                $("#tsumtotaltax").val(sumtax).trigger('change');
                $("#tsumqty").val(sumqty).trigger('change');
                if(document.getElementById('ctax').checked){
                  if(document.getElementById('includetax').checked){
                      pajak = sum /(1.1) ;
                      selisihpajak = parseFloat(sum-parseFloat(pajak)).toFixed(2)
                      $("#lttax").val(accounting.formatMoney(selisihpajak,'',2));
                      $("#ttax").val(selisihpajak);
                      $("#lsubtotal_after_tax").val(accounting.formatMoney(sum,'',2));
                      $("#subtotal_after_tax").val(sum);
                      $("#lsubtotal_before_tax").val(accounting.formatMoney(sum-selisihpajak,'',2));
                      $("#subtotal_before_tax").val(sum-selisihpajak);
                  }else{
                      pajak = sum*(1.1);
                      selisihpajak = parseFloat(parseFloat(pajak)-sum).toFixed(2)
                      $("#lttax").val(accounting.formatMoney(selisihpajak,'',2));
                      $("#ttax").val(selisihpajak);
                      $("#lsubtotal_after_tax").val(accounting.formatMoney(pajak,'',2));
                      $("#subtotal_after_tax").val(pajak);
                      $("#lsubtotal_before_tax").val(accounting.formatMoney(sum,'',2));
                      $("#subtotal_before_tax").val(sum);
                  }
                }else {
                  $("#lsubtotal_before_tax").val(accounting.formatMoney(sum,'',2));
                  $("#subtotal_before_tax").val(sum);
                  $("#lttax").val(accounting.formatMoney(0,'',2));
                  $("#ttax").val(0);
                  $("#lsubtotal_after_tax").val(accounting.formatMoney(sum,'',2));
                  $("#subtotal_after_tax").val(sum);
                }
                grandtotal()
            }
        })
    </script>
@endsection
