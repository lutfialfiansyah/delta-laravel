@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar" xmlns="http://www.w3.org/1999/html">
        <ul class="page-breadcrumb">
            <li>

            </li>
        </ul>
    </div>
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
                        <span class="caption-subject bold uppercase"> CN Transaction Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a  data-toggle="modal" href="#mdlstock" class="btn sbold green btn-circle btn-sm btnbrandadd" >Add New <i class="fa fa-plus"></i></a>
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
                            <th>CN NO</th>
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
    <div class="modal fade draggable-modal bs-modal-lg" id="mdlstock"  role="basic" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">CN Transaction</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formstock">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CN Transaction</label>
                                <input type="text" class="form-control" id="code" data-id="0" name="code" value="{{{isset($code)?$code:''}}}">
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div style="height:250px">
                                <div class="col-md-6">
                                    <table style="width:100%" class="table table-striped table-bordered table-hover table-checkable order-column table-stock2" id="table-cnDetail">
                                        <thead>
                                        <tr>
                                            <td colspan="5">CN Detail</td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>CN No</td>
                                            <td>Date</td>
                                            <td>Total</td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                <table style="width:100%" class="table table-striped table-bordered table-hover table-checkable order-column table-stock2" id="table-sales_transaction">
                                    <thead>
                                    <tr>
                                        <td colspan="6">Sales Transaction</td>
                                    </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>Sales Transaction No</td>
                                            <td>Date</td>
                                            <td>Total</td>
                                            <td>Pay</td>
                                            <td>Balance</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CN Amount</label>
                                    <input type="text" name="cn_amount" id="cn_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bill Amount</label>
                                    <input type="text" name="bill_amount" id="bill_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="hidden" name="amountuse" id="amountuse" class="form-control">
                                    <input type="text" name="Balance" id="Balance" class="form-control">
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
        <script type="text/javascript">
            $(function() {
                $("#purchaseTransaction").change(function(){
                    var totalharga = 0;
                    var selectedValues = [];
                    $("#purchaseTransaction :selected").each(function(){
                        totalharga = parseInt(totalharga)+ parseInt($(this).attr('data-price'));
                    });
                    $("#total").val(totalharga)
                    hitung()
                });
                function hitungcn(){
                    var sum = 0;
                    $('.grandcntotal:checked').each(function () {
                        sum += parseFloat($(this).attr('price'));
                    });
                    $("#cn_amount").val(sum);
                    $("#amountuse").val(sum);
                    $("#Balance").val(sum)
                }
                function hitungSt(){
                    var sum = 0;
                    var amount = $("#cn_amount").val();
                    $('.grandtotal:checked').each(function () {
                        sum += parseFloat($(this).attr('price'));
                    });
                    $("#Balance").val(amount-sum)
                    $("#amountuse").val(amount-sum)
                    $("#bill_amount").val(sum);
                }
                $(document).on('click','.grandcntotal',function(){
                    hitungcn()
                });
                $(document).on('click','.grandtotal',function(){
                    id = $(this).attr('data-id');
                    var grandtotal= $("#total").val();
                    var amount = $("#amountuse").val();
                    var price = $(".cgrandtotal_"+id).attr('price');
                    var totalsub= $(".cgrandtotal_"+id).attr('price');
                    if (this.checked){
                        if(parseInt(price) <= parseInt(amount)){
                            $(".cgrandtotal_"+id).attr('price',price);
                            $(".dibayar_"+id).val(price);
                            $(".balance_"+id).val(totalsub-price)

                        }else{
                            $(".cgrandtotal_"+id).attr('price',amount);
                            $(".dibayar_"+id).val(amount);
                            $(".balance_"+id).val(totalsub-amount)
                        }
                        hitungSt();
                    }else{
                        id = $(this).attr('data-id');
                        $(".cgrandtotal_"+id).attr('price',price);
                        $(".dibayar_"+id).val(0);
                        $(".balance_"+id).val(0)
                        hitungSt();
                        //grandtotal = parseFloat(grandtotal) - parseFloat($(".grantotal_"+$(this).attr('data-id')).val());
                        //$("#total").val(grandtotal);
                    }

                });
                $('#productid').change(function(){
                    $('#table-sales_transaction tbody').html("");
                    var count = $('#table-sales_transaction tbody tr').length;
                    var valuetable =""
                    $.get('{{url('api/salesTransaction/getSalesTransNoByCustomer')}}/'+$(this).val(),function(data){
                        console.log(data.msg);
                        $.each(data.msg,function(index, value){
                            valuetable = valuetable+"<tr>" +
                                "<td><input name='sales_transaction_id[]' discountprice='0' price='"+value['balance']+"' data-id='"+index+"' value='"+value['id']+"' class='grandtotal cgrandtotal_"+index+"' type='checkbox'></td>"+
                                "<td>"+value['sales_transaction_no']+"</td>"+
                                "<td>"+value['date']+"</td>"+
                                "<td>"+accounting.formatMoney(value['balance'],'Rp. ',2)+"</td>"+
                                "<td><input value='0' style='width:100px' data-id='"+index+"'class='form-control dibayar dibayar_"+index+"' name='total["+value['id']+"]'></td>"+
                                "<td><input value='0' data-id='"+index+"'class='form-control balance balance_"+index+"'></td>"+
                                "<tr>"
                        });
                        $("#table-sales_transaction tbody").append(valuetable)
                    })
                    $('#table-cnDetail tbody').html("");
                    var count = $('#table-cnDetail tbody tr').length;
                    var valuetable2 =""
                    $.get('{{url('api/cnTransaction/getCnTransactionById')}}/'+$(this).val(),function(data){
                        $.each(data.msg,function(index, value){
                            valuetable2 = valuetable2+"<tr>" +
                                "<td><input name='cn_detail[]' discountprice='0' price='"+value['balance']+"' data-id='"+index+"' value='"+value['id']+"' class='grandcntotal cgrandcntotal_"+index+"' type='checkbox'></td>"+
                                "<td>"+value['remarks']+"</td>"+
                                "<td>"+value['created_at']+"</td>"+
                                "<td><input type='hidden' name='cn_balance["+value['id']+"]' value='"+value['balance']+"'>"+accounting.formatMoney(value['balance'],'Rp. ',2)+"</td>"+
                                "<tr>"
                        });
                        $("#table-cnDetail tbody").append(valuetable2)
                    })
                });

                $(document).on('keyup','#discount',function(){
                    hitung()
                })
                $(document).on('keyup','#othercost',function(){
                    hitung()
                })
                $('.btnbrandadd').click(function(){
                    $("#total").val(0);
                    $("#subtotal").val(0);
                    $("#discount").val(0);
                    $("#othercost").val(0);
                    $('.select2').select2('val',0);
                });
                $('.select2').select2();
                $('.table-stock2').DataTable();
                var oTable = $('#table-stock').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('cnTransaction.getData') }}",
                    "fnDrawCallback": function () {
                        $("#table-stock a.stockedit").click(function () {
                            $("#code").val($(this).attr('data-total'));
                            $("#subtotal").val($(this).attr('data-subtotal'));
                            $("#code").attr('data-id', $(this).attr('data-id'));
                            $("#discount").val($(this).attr('data-discount'));
                            $("#othercost").val($(this).attr('data-other_cost'));
                            //SelectElement("productid",$(this).attr('data-productid'));
                            $(".btnall").addClass('btnedit');
                            $(".btnall").removeClass('btnadd');
                            $("#productid option[val="+$(this).attr('data-vendor_id')+"]").attr("selected", "selected");
                            //document.getElementById('#productid').value=$(this).attr('data-id');

                            $("#productid").val($(this).attr('data-vendor_id')).trigger('change')
                            $("#purchaseTransaction").append("<option selected value='"+$(this).attr('data-purchase_id')+"'>"+$(this).attr('data-purchase_no')+"</option>")
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
                                                url: '{{url('api/arPayment/deleteData/')}}/'+id,
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
                        {data: 'cn_transaction_no', name: 'name'},
                        {data: 'customer_name', name: 'name'},
                        {data: 'subtotal', name: 'total'},
                        {data: 'updated_by', name: 'updated_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'}
                    ]
                })
                var form = $('#formstock');
                $('#formstock').validate();
                $(".btnall").click(function() {
                    var dataid =  $("#code").attr('data-id');
                    var urls="";
                    if(dataid==0){
                        urls='{{route('cnTransaction.addData')}}';
                    }else{
                        urls='{{url('api/arPayment/updateData')}}/'+dataid;
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
                                //exit;
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