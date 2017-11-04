@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.customer') !!}</a>
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
    <h1 class="page-title"> Insert Customer
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Customer </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" id="formcustomer" method="" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Add Customer</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" id="code" required name="code" readonly value="{{$code}}" class="form-control" placeholder="B001">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <select  required class="form-control select2" name="branch">
                                        <option value="">Choose a branch</option>
                                        @foreach($branch as $row)
                                            <option value="{{$row->id}}">{{$row->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="name" required name="name" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Customer Group</label>
                                    <select class="form-control" required name="customer_group">
                                        <option value="">Choose a Customer Group</option>
                                        @foreach($customerGroups as $customerGroup)
                                            <option value="{{$customerGroup->id}}">{{$customerGroup->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Area</label>
                                    <select class="form-control" required name="area">
                                        <option value="1">Choose a Area</option>

                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Salesmen</label>
                                    <select class="form-control" required name="salesman" tabindex="1">
                                        <option value="">Choose a Salesman</option>
                                        @foreach($salesman as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Payment Term</label>
                                    <select class="form-control" required name="payment_term"  tabindex="1">
                                        <option value="">Choose a Payment Term</option>
                                        @foreach($paymentterms as $paymentterm)
                                            <option value="{{$paymentterm->id}}">{{$paymentterm->name}} | {{$paymentterm->total_period}} | {{$paymentterm->percent_discount}}% | {{$paymentterm->discount_period}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        {{--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">AR Limit</label>
                                    <input type="number" required name="ar_limit" class="form-control">
                                </div>
                            </div>

                        </div>--}}


                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="button" class="btn blue btnsaveproduct">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
            $(function(){
                var form = $('#formcustomer');
                $('#formcustomer').validate()
                $('.btnsaveproduct').click(function () {
                    var urls = '{{route('customer.addData')}}'
                    if(form.valid()) {
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formcustomer').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                console.log(data)
                                //alert(data.msg);

                                //location.reload();
                                swal({
                                        title: data.title,
                                        text: data.msg,
                                        type: data.type,
                                        confirmButtonClass: 'btn btn-success'
                                    }, (function () {
                                        if (data.status == true) {
                                            location.href = '{{url('customer')}}'
                                        }
                                    })
                                )
                            }
                        })
                    }
                })
            })
    </script>
@endsection
