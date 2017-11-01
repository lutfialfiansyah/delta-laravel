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
    <!-- END PAGE TITLE-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Branch Table</span>
                    </div>
                    <div class="actions">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="btn-group">
                                  <a href="#mdlGroup" data-toggle="modal" class="btn sbold green btnGroupAdd"> Add New
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
                                          <a href="javascript:;">
                                              <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="tblGroup">
                        <thead>
                        <tr>
                            <th> No</th>
                            <th> Code</th>
                            <th> Description</th>
                            <th> Area</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- /.modal -->
    <div id="mdlGroup" role="basic" class="modal fade draggable-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Insert</h4>
                </div>
                <div class="modal-body">
                    <form id="formGroup">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Code</label>
                                        <div>
                                            <input type="text" class="form-control" id="code" name="code" value="{{ $code }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <div><textarea class="form-control" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Area</label>
                                        <div>
                                            <select class="form-control" name="area">
                                                <option value="1">Bogor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="button" class="btn green btnAll" id="save_category">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.btnGroupAdd').click(function () {
                $('#groupName').val(null);
            })
            var oTable = $('#tblGroup').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('branch.getData') }}",
                "fnDrawCallback": function () {
                    $('#tblGroup a.btnGroupEdit').click(function () {
                        $('#groupName').val($(this).attr('data-name'));
                        $('#simbol').val($(this).attr('data-symbol'));
                        $('#groupName').attr('data-id', $(this).attr('data-id'));
                        $('.btnAll').addClass('btnEdit');
                        $('.btnAll').removeClass('btnAdd');
                        $('#mdlGroup').modal();
                    }),
                        $('a.delete').click(function () {
                            var id = $(this).attr('data-id');
                            swal({
                                title: "Delete category?",
                                text: "Category will be deleted on database?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-primary",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    var urls = "{{ url('currency/deleteData') }}/" + id;
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
                                        }
                                    });
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
                    {data: 'code', name: 'code'},
                    {data: 'description', name: 'simbol'},
                    {data: 'area_city_id', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
            var form = $('#formGroup');
            $('#formGroup').validate({
                rules: {
                    groupName: {
                        required: true
                    }
                },
                messages: {
                    groupName: {
                        required: "Please enter category name!"
                    }
                }
            })
            $('.btnAll').click(function () {
                if (form.valid()) {
                    var dataid = $('#groupName').attr('data-id');
                    var urls = '';
                    if (dataid == null) {
                        urls = '{{ route('branch.addData') }}'
                    } else {
                        urls = '{{ url('api/branch/updateData') }}/' + dataid;
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
                                $('#mdlGroup').modal('hide');
                                swal({
                                    title: data.title,
                                    text: data.text,
                                    type: data.type,
                                    confirmButtonClass: data.button
                                }, function () {
                                    $('#mdlGroup').modal();
                                })
                            }
                        }
                    })
                }
            })
        })

    </script>

@endsection
