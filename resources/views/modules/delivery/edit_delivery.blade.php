@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.delivery') !!}</a>
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
    <h1 class="page-title"> Insert Shipping Method
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Shipping Method </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" id="formshipping" method="" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Add Shipping Method</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" id="code" required name="code" value="{{$data->code}}" class="form-control" placeholder="B001">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="name" required name="name" value="{{$data->name}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Area</label>
                                    <select class="form-control" required name="vendor_id">
                                        <option value="1">Choose a Area</option>

                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="button" class="btn blue btnsaveshipping">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            var form = $('#formshipping');
            $('#formshipping').validate();
            $('.btnsaveshipping').click(function () {
                var urls='{{route('delivery.updateData',$data->id)}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formshipping').serialize(),
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
                                        location.href = '{{url('delivery')}}'
                                    }
                                })
                            )
                        }
                    });
                }
            })
        })
    </script>
@endsection