@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('salesTransaction.detail') !!}</a>
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
                                <span style="font-size: 24px;">detail Sales Transaction</span>
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
                                            <input type="text" readonly id="twerehouse" value="{{$st->werehouse->code."-".$st->werehouse->name}}" class="form-control">
                                            <input type="hidden" name="werehouse_id" id="werehouse" value="{{$st->werehouse->id}}" class="form-control">
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
                                        <div class="input-group">
                                            <input type="text" name="sales_transaction_no" readonly value="{{$st->sales_transaction_no}}" class="form-control">
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
                                            <input type="text" id="date" readonly required name="date" value="{{$st->date}}" class="form-control" placeholder="-">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                <div class="form-group">
                                    <label class="control-label  col-md-4">Customer</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="    cursor: pointer;" id="scustomer"><i class="fa fa-search"></i></span>
                                            <input type="text" id="customer"readonly required name="" value="{{$st->customer->name}}" class="form-control" placeholder="-">
                                            <input type="hidden" id="customer_id" readonly required name="customer_id" value="" class="form-control" placeholder="-">
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
                                                <input type="text" readonly id="term_of_payment" readonly required name="" value="{{$st->paymentTerm->name}}" class="form-control" placeholder="-">
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
                                                <input type="hidden" id="delivery_type_id" readonly name="delivery_type_id" value="" class="form-control" placeholder="-">
                                                <input type="text" readonly id="delivery_type" readonly required name="" value="{{$st->Delivery->code ."-".$st->Delivery->name}}" class="form-control" placeholder="-">
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
                                                <input type="text" readonly id="currency" value="{{$st->currency->symbol}}" required class="form-control" placeholder="-">
                                                <input type="hidden" id="currency_id" readonly required name="currency_id" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4">Sales Order No</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="    cursor: pointer;" id="salesorder"><i class="fa fa-search"></i></span>
                                                <input type="hidden" id="purchaseOrderId" required name="sales_order_id" value="" class="form-control" placeholder="-">
                                                <input type="text" value="{{$sales_order_no}}" readonly id="sales_order_id" required name="" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="form-group">
                                        <label class="control-label  col-md-4"></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input disabled type="checkbox" id="ctax"> Tax
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
                                        <label class="control-label">Bill to</label>
                                        <textarea class="form-control" rows="6"></textarea>
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
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php ($i = 1)
                                        @foreach($detail as $row)
                                          <tr>
                                              <td>{{$i}}</td>
                                              <td>{{$row->item_no}}</td>
                                              <td>{{$row->code}}</td>
                                              <td>{{$row->name}}</td>
                                              <td>{{$row->qty}}</td>
                                              <td>{{$row->unitname}}</td>
                                              <td>{{number_format($row->total,2)}}</td>
                                              <td>0</td>
                                              <td>{{number_format($row->total,2)}}</td>
                                          </tr>
                                        @php ($i++)
                                        @endforeach
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
                                    <textarea class="form-control" name="remarks">{{$st->remarks}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><strong>Subtotal before tax</strong></label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="hidden" name="subtotal_before_tax" id="subtotal_before_tax" class="form-control">
                                                    <input type="text" value="{{number_format($st->sub_total,2)}}" id="lsubtotal_before_tax" class="form-control">
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
                                                    <input type="text" value="{{number_format($st->tax_subtotal,2)}}" readonly id="lttax" class="form-control">
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
                                                    <input type="text" value="{{number_format($st->grand_total,2)}}" id="lsubtotal_after_tax" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Additional Discount</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" value="{{number_format($st->other_discount,2)}}" name="otherdiscount" id="otherdiscount" value="0.00" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Additional Cost</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" name="othercost" value="{{number_format($st->other_cost,2)}}" id="othercost" value="0.00" class="form-control">
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
                                                    <input type="text" value="{{number_format($st->grand_total_w_tax,2)}}" id="lgrandtotal" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <input type="hidden" required name="totalsum"  id="tsumtotal" value="" class="form-control">
                        </div>

                    </div>
                    <div class="form-actions center">
                        <center>
                        <a href="{{url('salesTransaction/edit/'.$st->id)}}" class="btn green btnSaveProduct">
                            <i class="fa fa-check"></i> Update
                          </a>
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
                                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-search"></i></span>
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
                                                    <label class="control-label col-sm-4">Qty</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" id="qty" class="form-control">
                                                        <input type="hidden" id="qtykali" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-search"></i></span>
                                                            <input type="hidden" id="unit_id" class="form-control">
                                                             <input type="text" id="unit" class="form-control">
                                                        </div>
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
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Discount</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <table class="table table-hover table-bordered" style="    margin-left: 6%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Discount</th>
                                                        <th>Remark</th>
                                                    </tr>
                                                </thead>
                                            </table>
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
                                                        <input id="salesman" name="" type="text" value="INDRA" class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Stock Avaielble</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Qty</th>
                                                                <th>Unit</th>
                                                            </tr>
                                                        </thead>
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
                                                    <table class="table table-hover table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td>Pak</td>
                                                            <td>=</td>
                                                            <td>6</td>
                                                            <td>PCS</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lsn</td>
                                                            <td>=</td>
                                                            <td>12</td>
                                                            <td>PCS</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ctn</td>
                                                            <td>=</td>
                                                            <td>120</td>
                                                            <td>PCS</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pallet</td>
                                                            <td>=</td>
                                                            <td>360</td>
                                                            <td>PCS</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cont</td>
                                                            <td>=</td>
                                                            <td>1200</td>
                                                            <td>PCS</td>
                                                        </tr>
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
                    <center>
                        <button type="button" class="btn btn-circle green btnall" >Add</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
