@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('product') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE TITLE-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Product Coa</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="#mdlinsert" data-toggle="modal" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
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
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-product">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>COA CODE</th>
                            <th>COA Name</th>
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
    <div id="mdlinsert" role="basic" class="modal fade draggable-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Product Coa</h4>
                </div>
                <div class="modal-body">
                    <form id="formExcel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product</label>
                                    <select required class="form-control select2" style="width:100%" name="product_id">
                                        <option value="">product list</option>
                                        @foreach($product as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sales Transaction</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sales Return</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sales Discount</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock Delivered</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>HPP</label>
                                    <select class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purchase Return</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product
                                        goods Uninvoiced</label>
                                    <select required class="form-control select2" style="width:100%" name="coa_list[]">
                                        <option value="">choose a coa list</option>
                                        @foreach($coalist as $row)
                                            <option value="{{$row->module_index_id}}-{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnsimpan">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script type="text/javascript">
        $(function() {
            $('.select2').select2();
            var oTable = $('#table-product').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('productCoa.getData') }}",
                "fnDrawCallback": function () {
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
                                        url: '{{url('api/productCoa/deleteData/')}}/'+id,
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
                    {data: 'product_name', name: 'product_name'},
                    {data: 'coa_id', name: 'coa_od'},
                    {data: 'coa_name', name: 'coa_name'},
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
//            EXCEL
            var formExcel = $('#formExcel');
            $('#formExcel').validate()
            $('.btnsimpan').click(function () {
                if (formExcel.valid()){
                    $.ajax({
                        url: '{{route('productCoa.addData')}}',
                        type: 'POST',
                        data: $('#formExcel').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data.msg)
                            //alert(data.msg);
                            //location.reload();*/
                            //exit;
                            $("#mdlinsert").modal('hide');
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
            })

        });
    </script>
@endsection