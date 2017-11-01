@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('unit') !!}</a>
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
                        <span class="caption-subject bold uppercase"> Unit Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="#insert" data-toggle="modal" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
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
                           id="unit">
                        <thead>
                        <tr>
                            <th> No</th>
                            <th> Unit</th>
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
    <div id="insert" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add Unit</h4>
                </div>

                <form class="formupdate"  action="{{ route('unit.addData') }}" method="post" id="unit" class="form-horizontal">
                    <div class="modal-body">
                        <div class="scroller" style="height:75px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="form-body">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : ''}}">
                                        <label class="col-md-4 control-label">Unit Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="unit_name" name="name">
                                            @if($errors->has('name'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <button type="submit" class="btn green" id="save_unit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="update" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Update Unit</h4>
                </div>

                <form class="formupdate" method="post" id="insert_unit" class="form-horizontal">
                    <div class="modal-body">
                        <div class="scroller" style="height:75px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Unit Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control mdlupdate" data-id="0" name="name"
                                                   value="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <button type="submit" class="btn green" id="update_unit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>

        @if( Session::has('flash_message') and Session::has('message'))
        swal({
            title: "{{ Session::get('message') }}",
            text: "{{ Session::get('flash_message') }}",
            type: "{{ Session::get('type') }}",
            confirmButtonClass: "{{ Session::get('confirm_button') }}",
            timer: "{{ Session::get('timer') }}"
        })
        @endif

        $('a#delete').on(true, function () {
            swal({
                title: "Delete Unit?",
                text: "Unit will be deleted on database?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary"
            }).then(function () {
//                url
            })
        });

        $(document).ready(function () {
            var oTable = $('#unit').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('unit.getData') }}",
                "fnDrawCallback":(function(){
                    $('#unit a.unitedit').click(function(){
                        $('.mdlupdate').val($(this).attr('data-name'));
                        $('#update').modal();
                        $('.formupdate').attr('action', '{{ url('unit/updateData') }}/' + $(this).attr('data-id'));
                    })
                    $('#unit a.unitdelete').click(function(){
                        var id=$(this).attr('data-id');
                       // alert(id);
                        swal({
                                title: "Delete Unit?",
                                text: "Unit will be deleted on database?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-primary",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    //alert(id);
                                    location.href = "{{ url('unit/deleteData') }}/" + id;
                                }
                            }
                        )
                    })
                }),
                "columns": [
                    {data: 'rownum', name: 'rownum'},
                    {data: 'name', name: 'name'},
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
            var form = $('#insert_unit');
            $('#insert_unit').validate({
                    rules: {
                        name: {
                            required: true,
                            remote:
                                {
                                    url: '{{url('unit/cekdata')}}',
                                    type: "post",
                                    data: {
                                        name: function () {
                                            return $("#name").val();
                                        }
                                    }
                                }
                        }, message: {
                            remote: "This Patch already exists."
                        }
                    }
                }
            );
        })
    </script>

@endsection