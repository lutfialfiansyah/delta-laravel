@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('detail.salesman') !!}</a>
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
    <h1 class="page-title"> Insert Salesman
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form salesman </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" id="formsalesman" method="" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Add salesman</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <span class="form-control">{{$salesman->code}}</span>
                                   </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <span class="form-control">{{$salesman->employee->first_namee}} {{$salesman->employee->last_name}}</span>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <span class="form-control">{{$salesman->branch->description}}</span>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Area</label>
                                    <span class="form-control">{{$salesman->area_id}}</span>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        {{--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phone 1</label>
                                    <span class="form-control"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phone 2</label>
                                    <span class="form-control"></span>
                                </div>
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <span class="form-control">{{$salesman->employee->email}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <a href="{{route('edit.salesman',$salesman->id)}}" class="btn blue">
                            <i class="fa fa-check"></i> Edit</a>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
@endsection