@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.vendors') !!}</a>
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
    <h1 class="page-title"> Update Vendor
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Vendor </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="{{route('vendors.updateData',$vendors->id)}}" id="formvendors" method="post" class="horizontal-form">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <h3 class="form-section">Edit Supplier</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input readonly type="text" value="{{$vendors->code}}" id="code" name="code" class="form-control" placeholder="S001">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : ''}}">
                                    <label class="control-label">Name</label>
                                    <input type="text" value="{{$vendors->name}}" id="name" name="name" class="form-control" placeholder="-">
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Vendor Group</label>
                                    <select id="vendor_group" name="vendor_group_id" class="form-control select2">
                                        <option></option>
                                        @foreach($vendorgroup as  $vg)
                                            <option @if( $vg->id ) selected @endif value="{{$vg->id}}" >{{ $vg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Payment Term</label>
                                    <select id="paymentterm" name="payment_term_id" class="form-control select2">
                                        <option></option>
                                        @foreach($pay as  $pays)
                                            <option @if( $pays->id ) selected @endif value="{{$pays->id}}" >{{ $pays->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Area</label>
                                    <select id="area" name="area_id" class="form-control select2">
                                        <option value=""></option>

                                        <option selected value="2">Dua</option>

                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : ''}}">
                                <div class="col-md-6">
                                    <label class="control-label">Address</label>
                                    <textarea class="form-control autosizeme" rows="3" placeholder="-" name="address">{{$vendors->address}}</textarea>
                                    @if($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone_1') ? ' has-error' : ''}}">
                                    <label class="control-label">Phone</label>
                                    <input type="text" value="{{$vendors->phone_1}}" id="name" name="phone_1" class="form-control" placeholder="-">
                                    @if($errors->has('phone_1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone_2') ? ' has-error' : ''}}">
                                    <label class="control-label">Phone 2</label>
                                    <input type="text" value="{{$vendors->phone_2}}" id="name" name="phone_2" class="form-control" placeholder="-">
                                    @if($errors->has('phone_2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : ''}}">
                                    <label class="control-label">Email</label>
                                    <input type="email" value="{{$vendors->email}}" id="name" name="email" class="form-control" placeholder="-">
                                    @if($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                    </div>
                    <div class="form-actions right">
                        <a href="{{route('vendors.view')}}"><button type="button" class="btn default">Cancel</button></a>
                        <button type="submit" class="btn blue btnsavevendor">
                            <i class="fa fa-check"></i> Update</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#vendor_group").select2({
                placeholder: "Choose a Vendor Group",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
                width: 'auto'
            });
            $("#area").select2({
                placeholder: "Choose a Area",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
                width: 'auto'
            });
            $("#paymentterm").select2({
                placeholder: "Choose a Area",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        });
    </script>
@endsection
