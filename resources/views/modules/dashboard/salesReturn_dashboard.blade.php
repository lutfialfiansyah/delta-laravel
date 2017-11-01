@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('salesReturn') !!}</a>
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
                        <span class="caption-subject bold uppercase"> Sales Return Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{url('/salesReturn/insert_salesReturn')}}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-print"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="#">
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
                            <th>Purchase Return No</th>
                            <th>Date</th>
                            <th>Total</th>
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

    {{--DATA TABLES--}}
    <script type="text/javascript">
        $(function() {
            $(".btnGroupdadd").click(function() {
                $(".btnall").removeClass('btnedit');
                $(".btnall").addClass('btnadd');
            })

            var oTable = $('#table-group').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('salesReturn.getData') }}",
                "fnDrawCallback": function () {
                    $("#table-group a.groupedit").click(function () {
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
                                            url: '{{url('api/purchaseReturn/deleteData/')}}/'+id,
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
                    {data: 'sales_return_no', name: 'name'},
                    {data: 'date', name: 'name'},
                    {data: 'total', name: 'name'},
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

            $(".btnall").click(function() {
                var dataid =  $("#groupname").attr('data-id');
                var urls="";
                if(dataid==0){
                    urls='{{route('productGroup.addData')}}';
                }else{
                    urls='{{url('api/productGroup/updateData')}}/'+dataid;
                }
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
                            },(function(){
                                location.reload()
                            })
                        )
                    }
                });
            });

        });
    </script>
@endsection