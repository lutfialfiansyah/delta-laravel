@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('subCategory') !!}</a>
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
                        <span class="caption-subject bold uppercase"> Sub Category Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="#mdlGroup" data-toggle="modal" class="btn sbold green btn-circle btn-sm btnTriggerAdd" >Add New <i class="fa fa-plus"></i></a>
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
                           id="groupTable">
                        <thead>
                        <tr>
                            <th> No</th>
                            <th> Category</th>
                            <th> Code</th>
                            <th> Sub category name</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div id="mdlGroup" role="basic" class="modal fade draggable-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Insert Category</h4>
                </div>
                <div class="modal-body">
                    <form id="formGroup">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sub Category Code</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $code }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <select id="category_id" name="category_id" class="form-control select2"
                                            style="width:100%">
                                        <option></option>
                                        @foreach($category as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sub Category Name</label>
                                    <input type="text" class="form-control" name="subcatname" id="subcatname">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnSubmitAll">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

        <script>
            $(function () {
                $('.btnTriggerAdd').click(function () {
                    $('#subcatname').val(null);
                    $('#category_id').val(null).trigger('change');
                    $('#category_id').attr(null).trigger('change');
                });

                $('.select2').select2({
                    placeholder: "Choose Category",
                    allowClear: true
                });
                var oTable = $('#groupTable').DataTable({
                    sDom: '<Rlfr<"branch"><t>p>',

                    colResize: {
                        resizeTable: true
                    },
                    autoWidth: false,
                    scrollX: false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('subCategory.getData') }}",
                    "fnDrawCallback": function () {
                        $('#groupTable a.btnTriggerEdit').click(function () {
                            $('#subcatname').val($(this).attr('data-name'));
                            $('#subcatname').attr('data-id', $(this).attr('data-id'));
                            $('.btnSubmitAll').addClass('btnEdit');
                            $('.btnSubmitAll').removeClass('btnAdd');
                            $("#category_id").val($(this).attr('data-catid')).trigger('change');
                            $('#mdlGroup').modal();
                        }),
                            $('a.btnTriggerDelete').click(function () {
                                var id = $(this).attr('data-id');
                                swal({
                                        title: "Delete sub category?",
                                        text: "Sub category will be deleted on database?",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonClass: "btn-primary",
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        if (isConfirm) {
                                            var urls = "{{ url('subCategory/deleteData') }}/" + id;
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
                                                    else{
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
                                            });
                                        }
                                    }
                                )
                            })
                    },
                    "columns": [
                        {
                            data: 'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                        },
                        {data: 'category_name', name: 'product_category.name'},
                        {data: 'code', name: 'code'},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                })
                var form = $('#formGroup');
                $('#formGroup').validate({
                    rules: {
                        category_id: {
                            required: true
                        },
                        subcatname: {
                            required: true
                        }
                    },
                    messages: {
                        category_id: {
                            required: "Please choose category!"
                        },
                        subcatname: {
                            required: "Please enter sub category name!"
                        }
                    }
                })
                $('.btnSubmitAll').click(function () {
                    if (form.valid()){
                        var dataid = $('#subcatname').attr('data-id');
                        var urls = '';
                        if (dataid == null) {
                            urls = '{{ route('subCategory.addData') }}';
                        } else {
                            urls = '{{ url('subCategory/updateData') }}/' + dataid;
                        }
                        $.ajax({
                            url: urls,
                            method: "POST",
                            data: $('#formGroup').serialize(),
                            datatype: "JSON",
                            success: function (data) {
                                if (data.status == true) {
                                    $('#mdlGroup').modal('hide');
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
                                    $('#mdlGroup').modal('hide')
                                    swal({
                                        title: data.title,
                                        text: data.text,
                                        type: data.type,
                                        confirmButtonClass: data.button
                                    },function () {
                                        $('#mdlGroup').modal()
                                    })
                                }
                            }
                        })
                    }
                })
            })
        </script>
@endsection