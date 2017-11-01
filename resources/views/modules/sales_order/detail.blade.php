@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('salesOrder.detail') !!}</a>
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
    <form action="" id="formPurchaserOrder" method="" class="horizontal-form">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Sales Order </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Sales Order</label>
                                    <input type="text" name="purchase_order_no" readonly value="{{$salesOrder->sales_order_no}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="date" readonly required name="date" value="{{$salesOrder->date}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Salesman</label>
                                    <input type="text" id="date" readonly required name="date" value="{{$salesOrder->salesman->code}}-{{$salesOrder->salesman->name}}" class="form-control" placeholder="-">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Customer</label>
                                    <input type="text" id="date" readonly required name="date" value="{{$salesOrder->customer->code}}-{{$salesOrder->customer->name}}" class="form-control" placeholder="-">
                                </div>
                            </div>
                            <!--/span-->
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
                    <div class="form-body">
                        <table class="table table-hover table-bordered" id="tabledetail">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Unit</th>
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
                                    <td>{{$row->unitname}}</td>
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
                                <td  bgcolor="#a9a9a9" colspan="7"></td>
                                <td><span id="sumtotal">Rp {{number_format($salesOrder->total)}}</span></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <a href="{{url('salesOrder/edit/'.$salesOrder->id)}}"><button type="button" class="btn blue btnAddProduct">
                                <i class="fa fa-check"></i> Edit</button>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </form>
@endsection