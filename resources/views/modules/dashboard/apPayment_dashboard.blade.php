@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('apPayment') !!}</a>
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
                        <span class="caption-subject bold uppercase"> Ap Payment  Table</span>
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
                            <th>Vendor</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Subtotal</th>
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
    <div class="modal fade " id="mdlstock"  role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">AP</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formstock">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select name="vendor_id"  id="productids" required="" style="width:100%" class="form-control select2">
                                        <option value="">-----</option>
                                        @foreach($vendor as $row)
                                            <option value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bank</label>
                                    <select name="bank"  required="" style="width:100%" class="form-control select2">
                                        <option value="">-----</option>
                                        @foreach($bank as $row)
                                            <option value="{{$row->id}}">{{$row->bankname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input name="amount"  id="nominal" required="" style="width:100%" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount Balance</label>
                                    <input name="amountbalance"  id="amountuse" required="" style="width:100%" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style="height:200px;overflow-x: scroll">
                                <div class="col-md-12">
                                    <table style="width:100%" class="table table-striped table-bordered table-hover table-checkable order-column" id="tabledetail">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Purchase Transaction No</td>
                                            <td>Date</td>
                                            <td>Sub Total</td>
                                            <td>Discount</td>
                                            <td>Sub Total - Discount</td>
                                            <td>Total</td>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub Total</label>
                                    <input type="text" required id="total" name="subtotal" data-id="0" class="form-control"> </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Discount Total</label>
                                    <input type="text" required id="discount_total" value="0" name="discount_total" data-id="0" class="form-control"> </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Grand Total</label>
                                    <input type="text" required id="subtotal" name="grand_total" data-id="0" class="form-control"> </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Over Payment</label>
                                    <input type="text" required id="difference" name="difference" data-id="0" class="form-control"> </div>
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
                function hitungGrand(){
                    var sum = 0;
                    var sumd = 0;
                    var amount = $("#nominal").val();
                    var amountbalance = 0;
                    $('.grandtotal:checked').each(function () {
                        sum += parseFloat($(this).attr('price'));
                        sumd += parseFloat($(this).attr('discountprice'));
                    });
                    $("#amountuse").val(amount-sum)
                    $("#total").val(sum);
                    $("#discount_total").val(sumd);
                }

                $('#productids').change(function(){
                    $('#tabledetail tbody').html("");
                    var count = $('#tabledetail tbody tr').length;
                    var valuetable =""
                    $.get('{{url('api/purchase/getPurchaseNoByVendor')}}/'+$(this).val(),function(data){
                        console.log(data.msg);
                        $.each(data.msg,function(index, value){
                            valuetable = valuetable+"<tr>" +
                                "<td><input name='sales_transaction_id["+value['id']+"]' discountprice='0' price='"+value['balance']+"' data-id='"+index+"' value='"+value['id']+"' class='grandtotal cgrandtotal_"+index+"' type='checkbox'></td>"+
                                "<td>"+value['purchase_transaction_no']+"</td>"+
                                "<td>"+value['date']+"</td>"+
                                "<td>"+accounting.formatMoney(value['balance'],'Rp. ',2)+"</td>"+
                                "<td><input value='0' data-id='"+index+"' data-price='"+value['grand_total']+"' class='form-control discount discount_"+index+"' name='discount["+value['id']+"]'></td>"+
                                "<td><input value ='"+value['balance']+"' class='form-control totaldiscount grantotal_"+index+"' name='grandtotal["+value['id']+"]'></td>"+
                                "<td><input value='0' data-id='"+index+"'class='form-control dibayar dibayar_"+index+"' name='total["+value['id']+"]'></td>"+
                                "<td><input value='0' data-id='"+index+"'class='form-control balance balance_"+index+"'></td>"+
                                "<tr>"
                        });
                        $("#tabledetail tbody").append(valuetable)
                    })
                });
                $(document).on('keyup','#nominal',function(){
                    $("#amountuse").val($(this).val());
                })
                $(document).on('keyup','.discount',function(){
                    price = $(this).attr('data-price');
                    id = $(this).attr('data-id');
                    total = price - $(this).val();
                    $(".cgrandtotal_"+id).attr('price',total);
                    $(".cgrandtotal_"+id).attr('discountprice',$(this).val());
                    $(".grantotal_"+id).val(total);
                    hitungGrand();
                    hitung();
                })
                $(document).on('click','.grandtotal',function(){
                    id = $(this).attr('data-id');
                    var grandtotal= $("#total").val();
                    var amount = $("#amountuse").val();
                    var price = $(".cgrandtotal_"+id).attr('price');
                    var totalsub= $(".grantotal_"+id).val();
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
                        hitungGrand()
                    }else{
                        id = $(this).attr('data-id');
                        $(".cgrandtotal_"+id).attr('price',price);
                        $(".dibayar_"+id).val(0);
                        $(".balance_"+id).val(0)
                        hitungGrand();
                        //grandtotal = parseFloat(grandtotal) - parseFloat($(".grantotal_"+$(this).attr('data-id')).val());
                        //$("#total").val(grandtotal);
                    }
                    hitung();
                });
                $(document).on('change','#purchaseTransaction',function(){
                    var price = $(this).select2().find(':selected').data('price');
                    $("#total").val(price)
                    hitung()
                })
                $(document).on('keyup','#othercost',function(){
                    hitung()
                })
                function hitung(){
                    var total = $("#total").val()
                    var discount =$("#discount_total").val()
                    if ($("#discount_total").val()==""){
                        discount =0
                    }
                    var other_cost = 0;
                    var subtotal = parseFloat(total)+parseFloat(other_cost);
                    $("#subtotal").val(subtotal)
                    $("#difference").val(parseFloat($('#nominal').val())-parseFloat(subtotal))
                }
                $('.btnbrandadd').click(function(){
                    $("#total").val(0);
                    $("#subtotal").val(0);
                    $("#discount").val(0);
                    $("#othercost").val(0);
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
                    "ajax": "{{ route('apPayment.getData') }}",
                    "fnDrawCallback": function () {
                        $("#table-stock a.stockedit").click(function () {
                            $("#total").val($(this).attr('data-total'));
                            $("#subtotal").val($(this).attr('data-subtotal'));
                            $("#total").attr('data-id', $(this).attr('data-id'));
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
                        {data: 'name', name: 'name'},
                        {data: 'amount', name: 'total'},
                        {data: 'discount_total', name: 'name'},
                        {data: 'subtotal', name: 'name'},
                        {data: 'updated_by', name: 'updated_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'}
                    ]
                })
                var form = $('#formstock');
                $('#formstock').validate();
                $(".btnall").click(function() {
                    var dataid =  $("#total").attr('data-id');
                    var urls="";
                    if(dataid==0){
                        urls='{{route('apPayment.addData')}}';
                    }else{
                        urls='{{url('api/apPayment/updateData')}}/'+dataid;
                    }
                    if(form.valid()) {
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formstock').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                console.log(data.msg)
                                //alert(data.msg);
                                //location.reload();*/
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