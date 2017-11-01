@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('warehouse') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Warehouse Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ url('/warehouse/insert_warehouse') }}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="warehouse">
                        <thead>
                        <tr>
                            <th> No</th>
                            <th> Branch</th>
                            <th> Code</th>
                            <th> Name</th>
                            <th> Description</th>
                            <th> Employee</th>
                            <th> Area</th>
                            <th> Address</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var oTable = $('#warehouse').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('warehouse.getData') }}",
                "fnDrawCallback": function () {
                    $('a.trigerdelete').click(function () {
                        var id = $(this).attr('data-id');
                        swal({
                            title: "Delete warehouse?",
                            text: "Warehouse will be deleted on database?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-primary",
                            closeOnConfirm: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                var urls = "{{ url('/warehouse/deleteData') }}/" + id;
                                $.ajax({
                                    url: urls,
                                    method: "GET",
                                    success: function (data) {
                                        if (data.status == true) {
                                            swal({
                                                title: data.title,
                                                text: data.text,
                                                type: data.type,
                                                confirmButtonClass: data.button
                                            }, function () {
                                                location.reload();
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
                        })
                    })
                },
                "columns": [
                    {
                        data: 'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    },
                    {data: 'branch_id', name: 'branch_id'},
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'employee_id', name: 'employee_id'},
                    {data: 'area_id', name: 'area_id'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
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
        })
    </script>

@endsection