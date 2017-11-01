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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
        @endif
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> COA Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a data-toggle="modal" href="#mdlGroup" class="btn sbold green btn-circle btn-sm btnGroupdadd" >Add New <i class="fa fa-plus"></i></a>
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-group">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Coa id</th>
                            <th>Name</th>
                            <th>Coa Code</th>
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
    <div class="modal fade draggable-modal" id="mdlGroup" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">CN Type</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formType">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Name</label>
                                    <input type="text" id="groupname" name="groupname" data-id="0" class="form-control"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Coa</label>
                                    <input type="hidden" name="coa_list_id" id="coa_list_id">
                                    <input type="text"  list="datacoa" class="form-control coalist">
                                    <datalist id="datacoa">
                                        <option value="">----</option>
                                       @foreach($coalist as $row)
                                           <option data-id="{{$row->id}}" value="{{$row->code}} - {{$row->name}}">{{$row->name}}</option>
                                       @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Coa</label>
                                    <select class="select2 form-control" style="width:100%" name="credit">
                                        <option value="">-----</option>
                                        <option value="0">Debit</option>
                                        <option value="1">Credit</option>
                                    </select>
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
                $("#code").removeAttr('readonly');
            })
            $(".coalist").change(function () {
                val = $('.coalist').val()
                datalist = $('#datacoa [value="' + val + '"]')
                var id = datalist.attr('data-id');
                $("#coa_list_id").val(id);
            })
            $(".select2").select2();
            var oTable = $('#table-group').DataTable({
                sDom: '<Rlfr<t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('coaControl.getData') }}",
                "fnDrawCallback": function () {
                    $("#table-group a.groupedit").click(function () {
                        $("#groupname").val($(this).attr('data-name'));
                        $("#coa_list_id").val($(this).attr('data-coa_list_id'));
                        $(".coalist").val($(this).attr('data-code') +"-"+ $(this).attr('data-coa_name'));
                        $("#groupname").attr('data-id',$(this).attr('data-id'));
                        $(".btnall").addClass('btnedit');
                        $(".btnall").removeClass('btnadd');
                        $("#mdlGroup").modal();
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
                                            url: '{{url('api/creditNoteType/deleteData/')}}/'+id,
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
                    {data: 'coa_list_id', name: 'name'},
                    {data: 'name', name: 'name'},
                    {data: 'coa_code', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'}
                ]
            })
            var form = $('#formType');
            $('#formType').validate();
            $(".btnall").click(function() {
                var dataid =  $("#groupname").attr('data-id');
                var urls="";
                if(dataid==0){
                    urls='{{route('coaControl.addData')}}';
                }else{
                    urls='{{url('api/coaControl/updateData')}}/' + dataid;
                }
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formType').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            /*console.log(data.msg)
                            alert(data.msg);
                            location.reload();*/
                            $("#mdlGroup").modal('hide');
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