@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('product') !!}</a>
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
    <h1 class="page-title"> Product
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Product Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{ url('/product/insert_product') }}" class="btn sbold green"> Add New
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('export.product','xlsx') }}">
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
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-product">
                        <thead>
                        <tr>
                            <td>#</td>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Brand</th>
                            <th>Group</th>
                            <th>Stok Min</th>
                            <th>Summary Stock</th>
                            <th>Price</th>
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
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('product.getDataRecycle') }}",
                "fnDrawCallback": function () {
                    $("a.restore").click(function () {
                        var id = $(this).attr('data-id');
                        swal({
                                title: "Restore?",
                                text: "data will be Restored on database?",
                                type: "info",
                                showCancelButton: true,
                                confirmButtonClass: "btn-primary",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    $.ajax({
                                        url: '{{url('api/product/restoreData/')}}/'+id,
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
                    {data: 'unit', name: 'unit'},
                    {data: 'type', name: 'type'},
                    {data: 'category', name: 'category'},
                    {data: 'subcategory', name: 'subcategory'},
                    {data: 'brand', name: 'brand'},
                    {data: 'group', name: 'group'},
                    {data: 'stock_minimum', name: 'stok_min'},
                    {data: 'summarystock', name: 'summarystock'},
                    {data: 'price', name: 'price'},
                    {data: 'action', name: 'action'}
                ]
            });
//            EXCEL
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
                        url: "{{ route('import.product') }}",
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