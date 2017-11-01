@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('detail.purchaseReturn') !!}</a>
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
                                    <span class="form-control">{{ $purchaseReturn->purchase_return_no}}</span>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                   <span class="form-control">{{ $purchaseReturn->date}}</span>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <span class="form-control">{{$branch->description}}</span>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <span class="form-control">{{ $purchaseReturn->warehouse->code}}-{{ $purchaseReturn->warehouse->name}}</span>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                    <span class="form-control">{{ $purchaseReturn->vendor->code}}-{{ $purchaseReturn->vendor->name}}</span>
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
                    <table class="table table-hover table-bordered" id="tabledetail">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Qty</th>
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
                                    <td>{{$row->unitname}}</td>
                                    <td>{{number_format($row->qty)}}</td>

                                    <td>Rp {{number_format($row->total)}}</td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td  bgcolor="#a9a9a9" colspan="5"></td>
                            <td><span id="sumtotal">Rp {{number_format( $purchaseReturn->total) }}</span></td>
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
                                    <span class="form-control">{{ $purchaseReturn->delivery->code}}-{{ $purchaseReturn->delivery->name}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <input type="text" name="totalsum" readonly  id="tsumtotal" value="Rp {{number_format( $purchaseReturn->total) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Remark</label>
                                    <textarea name='remark' readonly class='form-control'>{{ $purchaseReturn->remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <button type="button" class="btn default">Cancel</button>
                            <a class="btn blue " href="{{url('purchaseReturn/edit_purchaseReturn/'.$purchaseReturn->id)}}">
                                <i class="fa fa-pencil"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection