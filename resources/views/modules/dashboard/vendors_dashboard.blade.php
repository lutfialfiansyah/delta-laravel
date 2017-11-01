@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('vendors') !!}</a>
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
                        <span class="caption-subject bold uppercase"> Vendor Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ route('insert.vendors') }}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-vendors">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Vendor Group</th>
                            <th>Payment Term</th>
                            <th>Area</th>
                            <th>Address</th>
                            <th>Phone/Phone 2</th>
                            <th>Email</th>
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
        @if( Session::has('flash_message') and Session::has('message'))
        swal({
            title: "{{ Session::get('message') }}",
            text: "{{ Session::get('flash_message') }}",
            type: "{{ Session::get('type') }}",
            confirmButtonClass: "{{ Session::get('confirm_button') }}",
            timer: "{{ Session::get('timer') }}"
        })
        @endif
        $(function() {
            var oTable = $('#table-vendors').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('vendors.getData') }}",
                "columns": [
                    {data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'vendor_group_id', name: 'vendor_group_id'},
                    {data: 'payment_term_id', name: 'payment_term_id'},
                    {data: 'area_id', name: 'area_id'},
                    {data: 'address', name: 'address'},
                    {data: 'phone_1', name: 'phone_1'},
                    {data: 'email', name: 'email'},
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
            $('#table-vendors tbody').on('click', 'td', function (e) {
                var tr = $(this).closest('tr');
                var d = oTable.row(tr).data();
                if (e.target.id == 'trigerdelete') {
                    swal({
                        title: "Delete Record Vendor?",
                        text: "Vendor will be deleted on database?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            var hash = window.location.hash;
                            var urls = "{{ url('/vendors/deleteData') }}/" + hash.split('#')[1];
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
                                        }, function (isConfirm) {
                                            if (isConfirm) {
                                                location.href = "{{ route('vendors.view') }}"
                                            }
                                        })
                                    }
                                }
                            })
                        }
                    })
                }
            });
        });
    </script>
@endsection