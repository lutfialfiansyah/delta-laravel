@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('delivery') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Shipping Method Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ url('/delivery/insert_delivery') }}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-delivery">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Vendor</th>
                            <th>Created at</th>
                            <th>Update at</th>
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

    <script type="text/javascript">
        $(function() {
            var oTable = $('#table-delivery').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('delivery.getData') }}",
                "fnDrawCallback": function () {
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
                                        url: '{{url('api/delivery/deleteData/')}}/'+id,
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
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'vendor_id', name: 'vendor_id'},
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
        });
    </script>
@endsection