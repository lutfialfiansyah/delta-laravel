@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('view.customer') !!}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Customer Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ url('/customer/insert_customer') }}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="{{ route('export.customer','xlsx') }}">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="#mdlExcel" data-toggle="modal">
                                        <i class="fa fa-file-excel-o"></i> Import Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-responsive table-hover table-checkable order-column" id="table-product">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Customer Group</th>
                            <th>Payment Term</th>
                     <!--       <th>Ar Limit</th> !-->
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
    <!-- /.modal -->
    <div id="mdlExcel" role="basic" class="modal fade draggable-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Import Excel</h4>
                </div>
                <div class="modal-body">
                    <form id="formExcel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" id="import_excel" name="import_excel" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnSubmitExcel">Import Excel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script type="text/javascript">
        $(function() {
            var oTable = $('#table-product').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('customer.getData') }}",
                "fnDrawCallback":function () {
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
                                        url: '{{url('api/customer/deleteData/')}}/'+id,
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
                    {data: 'cgname', name: 'cgname'},
                    {data: 'paymentname', name: 'paymentname'},
                   // {data: 'ar_limit', name: 'ar_limit'},
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

//          EXCEL
            var formExcel = $('#formExcel');
            $('#formExcel').validate({
                rules: {
                    import_excel: {
                        required: true
                    }
                },
                messages: {
                    import_excel: {
                        required: "Please select excel file!"
                    }
                }
            })
            $('.btnSubmitExcel').click(function () {
                if (formExcel.valid()){
                    var formSubmit = $('#formExcel')[0];
                    var data = new FormData(formSubmit);
                    $.ajax({
                        url: "{{ route('import.customer') }}",
                        method: "POST",
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        datatype: "JSON",
                        enctype: 'multipart/form-data',
                        success: function (data) {
                            if (data.status == true) {
                                console.log('1');
                                $('#mdlExcel').modal('hide');
                                swal({
                                    title: data.title,
                                    text: data.text,
                                    type: data.type,
                                    confirmButtonClass: data.button
                                }, function () {
                                    location.reload();
                                })
                            }
                        }
                    })
                }
            })


        });
    </script>
@endsection
