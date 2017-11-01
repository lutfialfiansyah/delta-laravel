@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('customergroup') !!}</a>
            </li>
        </ul>

    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
        @endif
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Customer Group Table</span>
                    </div>
                    <div class="actions">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="btn-group">
                                  <a class="btn sbold green btnGroupdadd"  data-toggle="modal" href="#mdlCustomerGroup"> Add New
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
                    <div class="table-toolbar">

                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-customergroup">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Desciption</th>
                            <th>Created at</th>
                            <th>updated at</th>
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
    <div class="modal fade draggable-modal" id="mdlCustomerGroup" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Product Group</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formCgroup">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Group Name</label>
                                    <input type="text" id="groupname" required="" name="groupname" data-id="0" class="form-control"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" required="required" id="desc" class="form-control"></textarea>
                                </div>
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
            $(".btnGroupdadd").click(function() {
                $(".btnall").removeClass('btnedit');
                $(".btnall").addClass('btnadd');
            })

            var oTable = $('#table-customergroup').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('customerGroup.getData') }}",
                "fnDrawCallback": function () {
                    $("#table-customergroup a.groupedit").click(function () {
                        $("#groupname").val($(this).attr('data-name'));
                        $("#desc").val($(this).attr('data-desc'));
                        $("#groupname").attr('data-id',$(this).attr('data-id'));
                        $(".btnall").addClass('btnedit');
                        $(".btnall").removeClass('btnadd');
                        $("#mdlCustomerGroup").modal();
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
                                            url: '{{url('api/customerGroup/deleteData/')}}/'+id,
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
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
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
            var form = $('#formCgroup');
            $('#formCgroup').validate();
            $(".btnall").click(function() {
                var dataid =  $("#groupname").attr('data-id');
                var urls="";
                if(dataid==0){
                    urls='{{route('customerGroup.addData')}}';
                }else{
                    urls='{{url('api/customerGroup/updateData')}}/'+dataid;
                }
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formCgroup').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            /*console.log(data.msg)
                            alert(data.msg);
                            location.reload();*/
                            $("#mdlCustomerGroup").modal('hide');
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