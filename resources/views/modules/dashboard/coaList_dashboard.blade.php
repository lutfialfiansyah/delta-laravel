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
                        <span class="caption-subject bold uppercase"> COA  Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a data-toggle="modal" href="#mdlstock" class="btn sbold green btn-circle btn-sm btnbrandadd" >Add New <i class="fa fa-plus"></i></a>
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-stock">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Parent</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
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
    <div class="modal fade draggable-modal" id="mdlstock"  role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">List</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formstock">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" id="code" required name="code" value="" class="form-control" placeholder="B001">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" id="name" required name="name" value="" class="form-control" placeholder="-">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="form-control select2" id="type" style="width:100%" required name="type">
                                        <option value="">Choose a Type</option>
                                        @foreach($type as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <!--/span-->
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
        <script type="text/javascript">
            $(function() {
                $('.btnbrandadd').click(function(){
                    $("#code").val('');
                    $("#name").val('');
                    $('.select2').val().trigger('change');
                });
                $('.select2').select2();
                var oTable = $('#table-stock').DataTable({
                    sDom: '<Rlfr<t>p>',

                    colResize: {
                        resizeTable: true
                    },
                    autoWidth: false,
                    scrollX: false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('coalist.getData') }}",
                    "fnDrawCallback": function () {
                        $("#table-stock a.stockedit").click(function () {
                            $("#code").val($(this).attr('data-code'));
                            $("#name").val($(this).attr('data-name'));
                            //SelectElement("productid",$(this).attr('data-productid'));
                            $(".btnall").addClass('btnedit');
                            $(".btnall").removeClass('btnadd');
                            $("#type option[val="+$(this).attr('data-type')+"]").attr("selected", "selected");
                            //document.getElementById('#productid').value=$(this).attr('data-id');

                            $("#type").val($(this).attr('data-type')).trigger('change')
                            $("#type").append("<option selected value='"+$(this).attr('data-type')+"'>"+$(this).attr('data-type_name')+"</option>")
                            //$('#select').val('1').trigger('change.select2');
                            $("#mdlstock").modal();

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
                                                url: '{{url('api/apPayment/deleteData/')}}/'+id,
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
                        {data: 'parent', name: 'name'},
                        {data: 'code', name: 'name'},
                        {data: 'name', name: 'name'},
                        {data: 'type', name: 'total'},
                        {data: 'action', name: 'action'}
                    ]
                })
                var form = $('#formstock');
                $('#formstock').validate();
                $(".btnall").click(function() {
                    var dataid =  $("#code").attr('data-id');
                    var urls="";
                    if(dataid==0){
                        urls='{{route('coalist.addData')}}';
                    }else{
                        urls='{{url('api/coalist/updateData')}}/'+dataid;
                    }
                    if(form.valid()) {
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formstock').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                /*console.log(data.msg)
                                alert(data.msg);
                                location.reload();*/
                                $("#mdlstock").modal('hide');
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
    </div>
@endsection