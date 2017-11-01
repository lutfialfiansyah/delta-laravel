@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
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
    <h1 class="page-title"> Insert COA list
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form COA </div>
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
                        <h3 class="form-section">Add list</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" id="code" required name="code" value="{{{ isset($coalist->code) ? $coalist->code : '' }}}" class="form-control" placeholder="B001">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="name" required name="name" value="{{{ isset($coalist->name) ? $coalist->name : '' }}}" class="form-control" placeholder="-">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="form-control" required name="type">
                                        <option value="">Choose a Type</option>
                                        @foreach($type as $row)
                                            <option {{{isset($coalist->coa_type_id)?($coalist->coa_type_id==$row->id)?'selected':'':''}}} value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <!--/span-->
                        </div>
                        <!--/row-->
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
            $(".shippingDate").datepicker(
                {
                    autoclose:true,
                    format: 'yyyy/mm/dd'
                }
            )
            var form = $('#formcustomer');
            $('#formcustomer').validate()
            $('.btnsaveproduct').click(function () {
                @if(!isset($coalist->id))
                    var urls = '{{route('coalist.addData')}}'
                @else
                    var urls = '{{url('coalist/updateData')}}/{{$coalist->id}}'
                @endif

                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formcustomer').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data)
                            //alert(data.msg);
                            exit;
                            //location.reload();
                            swal({
                                    title: data.title,
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status == true) {
                                        location.href = '{{url('coalist')}}'
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