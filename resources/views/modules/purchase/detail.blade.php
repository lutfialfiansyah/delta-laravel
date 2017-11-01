@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('detail.purchase') !!}</a>
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
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Purchase</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Purchase</label>
                                    <span class="form-control">{{$purchase->purchase_transaction_no}}</span>
                                   </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <span class="form-control">{{$purchase->date}}</span>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <span class="form-control">{{$purchase->warehouse->name}}</span>
                                </div>
                            </div>
                            <!--/span-->

                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Purchase Order</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Purchase Order No</label>
                                    <span class="form-control">{{$purchase->purchaseOrder->purchase_order_no}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Total Purchase Order</label>

                                    <div class="input-group">
                                        <span id="totalpurchaseorder" class="form-control">Rp.  {{number_format($purchase->purchaseOrder->total)}}</span>
                                        <span class="input-group-btn totalpurchaseorder" data-id="{{$purchase->purchaseOrder->id}}">
                                                            <button class="btn blue" type="button">Detail</button>
                                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Vendor</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <span class="form-control">{{$purchase->vendor->code}}-- {{$purchase->vendor->name}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier Invoice</label>
                                    <span class="form-control">{{$purchase->supplier_invoice_no}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Payment Term</label>
                                    <span class="form-control">{{$purchase->paymentTerm->name}} -- {{$purchase->paymentTerm->total_period}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Detail</div>
                </div>
                <div class="portlet-body form">
                    <table class="table table-hover" id="tabledetail">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Percent Discount</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach($detail as $row)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$row->code}}-{{$row->name}}</td>
                                <td>Rp {{number_format($row->price)}}</td>
                                <td>{{number_format($row->qty)}}</td>
                                <td>{{number_format($row->discount)}}</td>
                                <td>{{number_format($row->percent_discount)}}</td>
                                <td>Rp {{number_format($row->total)}}</td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td  bgcolor="#ccc" colspan="6"></td>
                            <td><span id="sumtotal">Rp. {{number_format($purchase->total)}}</span></td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Shipping Method</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Shipping Method</label>
                                    <span class="form-control">{{$purchase->delivery->code}} - {{$purchase->delivery->name}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Shipping Date</label>
                                    <span class="form-control">{{$purchase->shipping_date}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <span class="form-control">{{ number_format($purchase->total)}}</span>
                                </div>
                            </div>
                        </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <a href="{{url('purchase/edit_purchase/'.$purchase->id)}}"><button type="button" class="btn blue btnAddProduct">
                            <i class="fa fa-check"></i> Edit</button>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-modal-lg" id="detailpurchaseorder" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Detail</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered" id="tabledetailmodel">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                               a <th>Percent Discount</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <script type="text/javascript">
        $(function(){
            $(".totalpurchaseorder").click(function () {
                $('#detailpurchaseorder').modal();
                $("#tabledetailmodel tbody").empty();
                var valuetable =""
                $.get('{{url('api/purchaseOrder/getDetail/')}}/'+$(this).attr('data-id'),function(data){
                    console.log(data);
                    var data = data.msg;

                    for(var i in data)
                    {
                        valuetable = valuetable+"<tr>" +
                            "<td>"+ (parseInt(i) + 1 )+"</td>"+
                            "<td>"+ data[i].name+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].price,'Rp. ',0)+"</td>"+
                            "<td>"+ data[i].qty+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].discount,'Rp. ',0)+"</td>"+
                            "<td>"+ data[i].percent_discount+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].total,'Rp. ',0)+"</td>"+
                            "</tr>"
                    }
                    $("#tabledetailmodel tbody").append(valuetable)
                    //console.log(valuetable)
                })


            })
        })
    </script>
@endsection