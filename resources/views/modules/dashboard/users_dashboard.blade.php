@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>

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
                        <span class="caption-subject bold uppercase">Users</span>
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
                            <th> Empoyee Code</th>
                            <th> First Name</th>
                            <th> Last Name</th>
                            <th> Email</th>
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
                    <h4 class="modal-title">Insert Users</h4>
                </div>
                <div class="modal-body">
                    <form id="formGroup">
                        <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="control-label col-sm-4">Employee Code</label>
                                  <div class="col-sm-8">
                                      <div class="input-group">
                                      <input name="employee_id" type="hidden"  style="width: 100%"  id="employee_id" class="form-control">
                                      <span class="input-group-addon"  id="semployee" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                      <input name=""  style="width: 100%"  id="employee" class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="control-label col-sm-4">First Name</label>
                                  <div class="col-sm-8">
                                      <div class="input-group" style="width:100%">
                                      <input style="width: 100%" id="first_name"  class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="control-label col-sm-4">Email</label>
                                  <div class="col-sm-8">
                                      <div class="input-group" style="width:100%">
                                      <input style="width: 100%" name="email" id="email"  class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="control-label col-sm-4">Password</label>
                                  <div class="col-sm-8">
                                      <div class="input-group" style="width:100%">
                                      <input style="width: 100%" required type="password" name="password" id="password"  class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top:10px">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label class="control-label col-sm-4">Confirm Password</label>
                                  <div class="col-sm-8">
                                      <div class="input-group"  style="width:100%">
                                      <input style="width: 100%" required type="password" name="cpassword" id="cpassword"  class="form-control">
                                      </div>
                                  </div>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
              $("#employee").autocomplete({
                  source:function(request,response){
                      $.ajax( {
                          url: "{{url('api/employee/getAllData')}}",
                          //url: "{{url('api/product/getAllsData')}}",
                          dataType: "json",
                          data: {
                              code: request.term
                          },
                          success: function( data ) {
                              response($.map(data.data, function (value, key) {
                                  //console.log(value)
                                  return {
                                      label: value.employee_no+"-"+value.first_name,
                                      value: value.employee_no,
                                      first_name:value.first_name,
                                      email: value.email,
                                      id:value.id
                                  };
                              }));
                          },
                      });
                  },minLength:0
              }).focus(function(){
                  $(this).data("uiAutocomplete").search($(this).val());
              });
              $( "#employee" ).on( "autocompleteselect", function( event, ui ) {
                  $('#employee_id').val(ui.item.id).trigger('change')
                  $('#first_name').val(ui.item.first_name).trigger('change')
                  $('#email').val(ui.item.email).trigger('change')
              })
              $( "#semployee" ).click(function(){
                  $('#employee').val('').focus()
              })
                var oTable = $('#groupTable').DataTable({
                    sDom: '<Rlfr<"branch"><t>p>',

                    colResize: {
                        resizeTable: true
                    },
                    autoWidth: false,
                    scrollX: false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('users.getData') }}",
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
                                                            text: data.msg,
                                                            type: data.type
                                                        }, function () {
                                                            location.reload();
                                                        })
                                                    }
                                                    else{
                                                        swal({
                                                            title: data.title,
                                                            text: data.text,
                                                            type: data.type
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
                        {data: 'employee_no', name: 'employee_no.name'},
                        {data: 'first_name', name: 'fisrt_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                })
                var form = $('#formGroup');
                $('#formGroup').validate();
                $('.btnSubmitAll').click(function () {
                    if (form.valid()){
                      var password = $("#password").val();
                      var cpassword = $("#cpassword").val();
                      $('#mdlGroup').modal('hide')
                      if(password != cpassword){
                            swal({
                                title:'Ops',
                                text:'Password must same with confirm password',
                                type: 'warning'
                            }, function () {
                                $('#mdlGroup').modal();
                            })
                      }
                      urls ="{{route('users.addData')}}"
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
