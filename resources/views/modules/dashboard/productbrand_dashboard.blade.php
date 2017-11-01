@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('brand') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
             @endif
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Brand Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a data-toggle="modal" href="#mdlBrand" class="btn sbold green btn-circle btn-sm btnbrandadd" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Import Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-brand">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="modal fade draggable-modal" id="mdlBrand" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Product Brand</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formbrand">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>code</label>
                                <input type="text" id="code" name="code" value="{{$code}}" class="form-control"> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <input type="text" id="brandname" name="brandname" data-id="0" class="form-control"> </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnall">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--DATA TABLES--}}
    <script type="text/javascript">
        $(function() {
            $(".btnbrandadd").click(function() {
                $(".btnall").removeClass('btnedit');
                $(".btnall").addClass('btnadd');
                $("#code").removeAttr('readonly');
            })

            var oTable = $('#table-brand').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('productbrand.getData') }}",
                "fnDrawCallback": function () {
                    $("#table-brand a.brandedit").click(function () {
                        $("#brandname").val($(this).attr('data-name'));
                        $("#code").val($(this).attr('data-code'));
                        $("#code").attr('readonly','readonly');
                        $("#brandname").attr('data-id',$(this).attr('data-id'));
                        $(".btnall").addClass('btnedit');
                        $(".btnall").removeClass('btnadd');
                        $("#mdlBrand").modal();
                    }),
                        $("a.delete").click(function () {
                            var id = $(this).attr('data-id');
                            swal({
                                    title: "Delete?",
                                    text: "data will be deleted on database?",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-primary",
                                    closeOnConfirm: false
                                }, function (isConfirm) {
                                    if (isConfirm) {
                                        $.ajax({
                                            url: '{{url('api/brand/deleteData/')}}/'+id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                /*console.log(data.msg)
                                                alert(data.msg);
                                                location.reload();*/
                                                swal({
                                                        title: data.title,
                                                        text: data.msg,
                                                        type: data.type,
                                                        confirmButtonClass: 'btn btn-success'
                                                    },(function(){
                                                        location.reload()
                                                    })
                                                )
                                            }
                                        });
                                    }
                                }
                            )
                        })
                },
                "columns": [
                    {data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'code', name: 'name'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'}
                ]
            });
            var branch="";
            $.get('{{url('api/branch/getBranch')}}',function(data){
                console.log(data);
                $.each(data.msg,function(index,value){
                    branch += "<option value='"+value['id']+"'>"+value['description']+"</option>"
                });
                $("div.branch").html('<label><select name="branch"><option value="">All</option>'+branch+'</select></label>');
            });
            var form = $('#formbrand');
            $('#formbrand').validate();
            $(".btnall").click(function() {
                var dataid =  $("#brandname").attr('data-id');
                var urls="";
                if(dataid==0){
                    urls='{{route('productbrand.addData')}}';
                }else{
                    urls='{{url('api/brand/updateData')}}/'+dataid;
                }
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formbrand').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data)
                            //alert(data.msg);
                            //location.reload();*/
                            $("#mdlBrand").modal('hide');
                            swal({
                                    title: data.title,
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    location.reload()
                                })
                            )
                        }
                    });
                }
            });

        });
    </script>
@endsection