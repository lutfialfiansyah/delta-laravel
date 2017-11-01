@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.warehouse') !!}</a>
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
    <h1 class="page-title"> Edit Warehouse
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->
    {{--@foreach($warehouse as $value)--}}
        {{--@endforeach--}}
    <div class="tab-pane">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Edit Warehouse </div>
                <div class="tools">
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="formupdate" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Edit Warehouse</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <select id="branch_id" name="branch_id" class="form-control"  >
                                        <option value=""></option>
                                        @foreach($branch as $branchs)
                                        <option @if($branchs->id) selected @endif value="{{$branchs->id}}">{{$branchs->description}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input readonly type="text" id="code" name="code" class="form-control" value="{{ $warehouse->id }}"  >
                                   </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $warehouse->name }}"  >
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Employee</label>
                                    <select id="employee_id" name="employee_id" class="form-control"  >
                                        <option value=""></option>
                                        @foreach($employee as $employees)
                                            <option @if($employees->id) selected @endif value="{{$employees->id}}">{{$employees->first_name.' '.$employees->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Area</label>
                                    <select name="area_id" id="area_id" class="form-control" >
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" >{{ $warehouse->description }}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <textarea name="address" id="address" class="form-control" >{{ $warehouse->address }}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="submit" id="btnupdate" class="btn blue">
                            <i class="fa fa-check"></i>
                            Save
                        </button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#formupdate').validate({
                rules: {
                    name: {
                        required: true
                    },
                    employee_id: {
                        required: true
                    },
                    area_id: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    address: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name!"
                    },
                    eployee_id: {
                        required: "Please choose employee!"
                    },
                    area_id: {
                        required: "Please choose area!"
                    },
                    description: {
                        required: "Please enter description!"
                    },
                    address: {
                        required: "Please enter address!"
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: "/warehouse/updateData/{{ $warehouse->id }}",
                        method: "POST",
                        data: $('#formupdate').serialize(),
                        datatype: "JSON",
                        success: function (data) {
                            if (data.status == true){
                                swal({
                                    title: data.title,
                                    text: data.text,
                                    type: data.type,
                                    confirmButtonClass: data.button
                                },function (isConfirm) {
                                    if (isConfirm){
                                        location.href = "{{ route('warehouse') }}"
                                    }
                                })
                            }
                            if (data.status == false){
                                swal({
                                    title: data.title,
                                    text: data.text,
                                    type: data.type,
                                    confirmButtonClass: data.button
                                })
                            }
                        }
                    })
                }
            });


            $("#branch_id").select2({
                placeholder: "Choose a Branch"
            });
            $("#employee_id").select2({
                placeholder: "Choose a Employee"
            });
            $("#area_id").select2({
                placeholder: "Choose a Area"
            });

        })
    </script>

@endsection
