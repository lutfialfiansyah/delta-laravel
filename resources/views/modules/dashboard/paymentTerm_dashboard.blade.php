@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('paymentTerm') !!}</a>
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
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Payment Term Table</span>
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
                           id="tblGroup">
                        <thead>
                        <tr>
                            <th> No</th>
                            <th> Name</th>
                            <th> Total period</th>
                            <th> Percent discount</th>
                            <th> Discount period</th>
                            <th> Remarks</th>
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
                    <h4 class="modal-title">Insert Payment Term</h4>
                </div>
                <form id="formGroup" class="form-horizontal" role="form">
                    <div class="modal-body">
                        <div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name"
                                                   autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Total period</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="total_period"
                                                   id="total_period">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Percent discount</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="percent_discount"
                                                   id="percent_discount">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Discount period</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="discount_period"
                                                   id="discount_period">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="remarks" id="remarks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <button type="button" class="btn green btnSubmitAll">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.btnTriggerAdd').click(function () {
                $('#name').val(null);
                $('#total_period').val(null);
                $('#percent_discount').val(null);
                $('#discount_period').val(null);
                $('#remarks').val(null);
            })

            var oTable = $('#tblGroup').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('paymentTerm.getData') }}",
                "fnDrawCallback": function () {
                    $('#tblGroup a.btnTriggerEdit').click(function () {
                        var tr = $(this).closest('tr')
                        var d = oTable.row(tr).data();
                        $('#name').val($(this).attr('data-name'));
                        $('#name').attr('data-id', $(this).attr('data-id'))
                        $('#total_period').val(d.total_period);
                        $('#percent_discount').val(d.percent_discount);
                        $('#discount_period').val(d.discount_period);
                        $('#remarks').val(d.remarks);
                        $('.btnSubmitAll').addClass('btnEdit');
                        $('.btnSubmitAll').removeClass('btnAdd');
                        $('#mdlGroup').modal();
                    }),
                        $('a.btnTriggerDelete').click(function () {
                            var id = $(this).attr('data-id');
                            swal({
                                title: "Delete payment term?",
                                text: "Payment term will be deleted on database?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-primary",
                                closeOnConfirm: false
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    var urls = "{{ url('paymentTerm/deleteData') }}/" + id;
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
                    {data: 'name', name: 'name'},
                    {data: 'total_period', name: 'total_period'},
                    {data: 'percent_discount', name: 'percent_discount'},
                    {data: 'discount_period', name: 'discount_period'},
                    {data: 'remarks', name: 'remarks'},
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
            var form = $('#formGroup');
            $('#formGroup').validate({
                rules: {
                    name: {
                        required: true
                    },
                    total_period: {
                        required: true,
                        number: true
                    },
                    percent_discount: {
                        required: true,
                        number: true
                    },
                    discount_period: {
                        required: true,
                        number: true
                    },
                    remarks: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name!"
                    },
                    total_period: {
                        required: "Please enter total period!",
                        number: "Total period must be a number!"
                    },
                    percent_discount: {
                        required: "Please enter percent discount!",
                        number: "Total period must be a number!"
                    },
                    discount_period: {
                        required: "Please enter discount period!",
                        number: "Total period must be a number!"
                    }
                }
            })

            $('.btnSubmitAll').click(function () {
                if (form.valid()){
                    var dataid = $('#name').attr('data-id');
                    var urls = '';
                    if (dataid == null) {
                        urls = '{{ url('/paymentTerm/addData') }}';
                    } else {
                        urls = '{{ url('paymentTerm/updateData') }}/' + dataid;
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
                                    },function () {
                                        $('#mdlGroup').modal();
                                    }
                                )
                            }
                        }
                    })
                }
            })
        })



    </script>



@endsection