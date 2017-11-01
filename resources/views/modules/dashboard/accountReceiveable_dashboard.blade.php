@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('accountReceivable') !!}</a>
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
                        <span class="caption-subject bold uppercase"> AR  Table</span>
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
                            <td>#</td>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Create by</th>
                            <th>Create at</th>
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
                    <h4 class="modal-title">AR</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formstock">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="vendor_id"  id="productid" required="" style="width:100%" class="form-control select2">
                                        @foreach($customer as $row)
                                            <option value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" required id="qty" name="total" data-id="0" class="form-control"> </div>
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
        <script type="text/javascript">
            $(function() {
                $('.btnbrandadd').click(function(){
                    $("#qty").val(0);
                    $('.select2').select2('val',0);
                });
                $('.select2').select2();
                var oTable = $('#table-stock').DataTable({
                    sDom: '<Rlfr<"branch"><t>p>',

                    colResize: {
                        resizeTable: true
                    },
                    autoWidth: false,
                    scrollX: false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('accountReceivable.getData') }}",
                    "fnDrawCallback": function () {
                        $("#table-stock a.stockedit").click(function () {
                            $("#qty").val($(this).attr('data-qty'));
                            $("#qty").attr('data-id', $(this).attr('data-id'));
                            //SelectElement("productid",$(this).attr('data-productid'));
                            $(".btnall").addClass('btnedit');
                            $(".btnall").removeClass('btnadd');
                            $("#productid option[val="+$(this).attr('data-id')+"]").attr("selected", "selected");
                            //document.getElementById('#productid').value=$(this).attr('data-id');
                            $("#productid").val($(this).attr('data-productid')).trigger('change')
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
                                                url: '{{url('api/accountReceivable/deleteData/')}}/'+id,
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
                        {data: 'total', name: 'total'},
                        {data: 'updated_by', name: 'updated_by'},
                        {data: 'created_at', name: 'created_at'},
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
                var form = $('#formstock');
                $('#formstock').validate();
                $(".btnall").click(function() {
                    var dataid =  $("#qty").attr('data-id');
                    var urls="";
                    if(dataid==0){
                        urls='{{route('accountReceivable.addData')}}';
                    }else{
                        urls='{{url('api/accountReceivable/updateData')}}/'+dataid;
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