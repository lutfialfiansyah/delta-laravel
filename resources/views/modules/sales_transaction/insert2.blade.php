@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('salesTransaction.insert') !!}</a>
            </li>
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm"
                 data-container="body"
                 data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->
    <form action="" id="formPurchaser" method="" class="horizontal-form">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box">
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row" style="    border-bottom: solid 1px #ccc;
    padding-bottom: 16px;">
                            <div class="col-md-8">
                                <span style="font-size: 24px;">Create Sales Transaction</span>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Branch</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-search"></i></span>
                                                <input type="text" list="branch" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:5px">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Werehouse</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-search"></i></span>
                                                <input type="text" list="branch" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Sales</label>
                                    <input type="text" name="sales_transaction_no" readonly value="{{$code}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="date" required name="date" value="{{date('Y/m/d')}}" class="form-control" placeholder="-">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <select required name="warehouse_id" style="width: 100%"  class="form-control select2">
                                        <option value="" id="default">-----</option>
                                        @foreach($warehouse as $row)
                                            <option value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Salesman</label>
                                    <select required name="salesman_id" style="width: 100%"  class="form-control select2">
                                        <option value="" id="default">-----</option>
                                        @foreach($salesman as $row)
                                            <option value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Customer</label>
                                    <select required name="customer_id" style="width: 100%"  class="form-control customerid select2">
                                        <option value="" id="default">-----</option>
                                        @foreach($customer as $row)
                                            <option data-paymentterm="{{$row->payment_term_id}}" value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Payment Term</label>
                                    <input type="hidden" id="payment_term_id" name="payment_term_id">
                                    <span class="form-control paymentterm" style="font-size:14px"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Sales Order</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Sales Order No</label>
                                    <select required name="sales_order_id" style="width: 100%"  id="purchaseOrderId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($salesOrder as $row)
                                            <option data-price="{{$row->total}}" data-id="{{$row->id}}" value="{{$row->id}}">{{$row->sales_order_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Total Sales Order</label>
                                    <span id="totalpurchaseorder" class="form-control"></span>
                                    <span class="input-group-btn totalpurchaseorder"  style="    font-size: 14px;"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Detail
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-default btn-sm addplusProd">
                            <i class="fa fa-plus"></i> Add </button>
                    </div>
                </div>
                <div class="portlet-body form">
                    <table class="table table-hover table-bordered" id="tabledetail">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th style="100px">Qty</th>
                            <th style="100px">Unit</th>
                            <th>Discount</th>
                            <th>Percent Discount</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7" style="text-align: right">Sub Total </td>
                            <td><span id="sumtotal"></span></td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Shipping Method</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Other Discount</label>
                                    <input type="text" name="otherdiscount" id="otherdiscount" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Other Cost</label>
                                    <input type="text" name="othercost" id="othercost" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Grand total</label>
                                    <input type="text" name="grandtotal" id="grandtotal" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Delivery type</label>
                                    <select required name="shopping_method" style="width: 100%"  id="purchaseSmId" class="form-control select2">
                                        <option value="" id="default">-----</option>
                                        @foreach($shippingMethod as $row)
                                            <option value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" required name="totalsum"  id="tsumtotal" value="" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Remarks</label>
                                    <textarea name="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <button type="button" class="btn default">Cancel</button>
                            <button type="button" class="btn blue  btnSaveProduct">
                                <i class="fa fa-check"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="detailpurchaseorder"  aria-labelledby="myModalLabel"  role="dialog" aria-hidden="true">
        <div class="modal-dialog cascading-modal" rule="document">
            <div class="modal-content">
                <div class="modal-header light-blue darken-3 white-text">
                    <h4 class="title"><i class="fa fa-pencil"></i>Product</h4>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Product</label>
                                <input name="product_id"  style="width: 100%"  id="productid" list="parentproduct" class="form-control datalistp">
                                <datalist id="parentproduct">
                                    <option value="0" id="default">-----</option>
                                    @foreach($products as $product)
                                        <option data-price="{{$product->price}}" id="{{$product->id}}" value="{{$product->code}}-{{$product->name}}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Price</label>
                                <input type="number" id="price"  name="price" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Qty</label>
                                <input type="number" id="qty"  name="qty" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Unit</label>
                                <select style="font-size: 14px" name=""id="unitid" class="form-control unit">
                                    <option value="0" id="default">-----</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Discount</label>
                                <input type="number" id="discount"  name="discount" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Percent Discount</label>
                                <input type="number" id="pdiscount"  name="pdiscount" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Total</label>
                                <input type="text" id="total"  name="total" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnall" >Add</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            function grandtotal(){
                var subtotal = $('#tsumtotal').val();
                var otherdiscount = $('#otherdiscount').val();
                var othercost = $('#othercost').val();
                $("#grandtotal").val(subtotal-otherdiscount + parseInt(othercost));
            }
            $(document).on("keyup", '#otherdiscount',function(){
                grandtotal()
            })
            $(document).on("keyup", '#othercost',function(){
                grandtotal()
            })
            $(document).on("change", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
                $('.unit').empty();
                $('.unit').append('<option value="">---</option>');
                var id =datalist.attr('id');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.unit')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })
            $(document).on("click", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
                var id =datalist.attr('id');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.unit')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })

            $(".addplusProd").click(function(){
                $('.datalistp').val()
                $("#detailpurchaseorder").modal();
                $(".btnall").html("<i class ='icon-plus'></i> Add")
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                $(".btnall").addClass('btnAddProduct')
                $(".btnall").removeClass('btneditProduct')
            })
            $(".shippingDate").datepicker(
                {
                    autoclose:true,
                    format: 'yyyy/mm/dd'
                }
            )
            $(".select2").select2()

            $("#qty").change(function(){
                total = $('#price').val()*$(this).val()
                $("#total").val(total)
            })
            $("#discount").change(function(){
                total = $('#price').val()*$('#qty').val()
                $("#total").val(total- $(this).val())
            })
            $("#pdiscount").change(function(){
                total = $('#price').val()*$('#qty').val()-$('#discount').val()
                pdiscount = (total * $(this).val())/100
                $("#total").val(total- pdiscount)
            })
            var sumtotal=0;
            $(document).on("click", '.editPurchseOrder',function(){
                $(".btnall").removeAttr('index')
                var index = $(this).attr('data-index')
                $(".btnall").attr('index',index)
                $(".btnall").html("<i class ='icon-check'></i> Update")
                var id = $(this).attr('data-id')
                var value = $(this).attr('data-value')
                var price = $(this).attr('data-price')
                var qty = $(this).attr('data-qty')
                var discount = $(this).attr('data-discount')
                var pdiscount = $(this).attr('data-pdiscount')
                var total = $(this).attr('data-total')
                $("#qty").val(qty);
                $("#price").val(price);
                $("#discount").val(discount);
                $("#pdiscount").val(pdiscount);
                $("#total").val(total);
                //
                $("#detailpurchaseorder").modal();
                $("#productid").val(value).trigger('change')

                $(".btnall").removeClass('btnAddProduct')
                $(".btnall").addClass('btneditProduct')

            })
            $(document).on("click", '.btneditProduct',function(){
                $("#qty_"+$(this).attr('index')).val($("#qty").val());
                $("#product_"+$(this).attr('index')).val($("#productid").attr('data-id'));
                $("#lproduct_"+$(this).attr('index')).html($("#productid").val());
                $("#price_"+$(this).attr('index')).val($("#price").val());
                $("#discount_"+$(this).attr('index')).val($("#discount").val());
                $("#pdiscount_"+$(this).attr('index')).val($("#pdiscount").val());
                $("#total_"+$(this).attr('index')).val($("#total").val());
                $("#total_"+$(this).attr('index')).attr('price',$("#total").val());
                $("#ltotal_"+$(this).attr('index')).html(accounting.formatMoney($("#total").val(),'Rp ',0));
                $("#detailpurchaseorder").modal('hide');
                hitung()
            })
            $(document).on("click", '.btnAddProduct',function(){
                if($("#productid").val()==0){
                    swal("Product Can't Empty")
                    exit;
                }
                $("#detailpurchaseorder").modal('hide');
                var count = $('#tabledetail tbody tr').length;
                var table = document.getElementById("tabledetail").getElementsByTagName('tbody')[0];
                var row = table.insertRow(count)
                var no = row.insertCell(0)
                var productName = row.insertCell(1)
                var price = row.insertCell(2)
                var qty = row.insertCell(3)
                var unit = row.insertCell(4)
                var discount = row.insertCell(5)
                var pdiscount = row.insertCell(6)
                var total = row.insertCell(7)
                var action = row.insertCell(8)
                var actions ="<button type='button'" +
                    "data-id='" + $("#productid").attr('data-id') + "'" +
                    "data-value='" + $("#productid").val() + "'" +
                    "data-unitid='" + $("#unitid").val() + "'" +
                    "data-index='" + count + "'" +
                    "data-price='" + $("#price").val() + "'" +
                    "data-qty='" + $("#qty").val() + "'" +
                    "data-discount='" + $("#discount").val() + "'" +
                    "data-pdiscount='" + $("#pdiscount").val() + "'" +
                    "data-total='" + $("#total").val() + "'" +
                    "class='btn btn-info editPurchseOrder' ><i class='icon-note'></i></button>" +
                    "<button type='button' data-index='"+count+"' class='btn btn-danger delete'><i class='icon-trash'></i></button>";
                no.innerHTML=count+1
                productName.innerHTML = "<input type='hidden' id='product_"+count+"' name='productid[]' value='"+$("#productid").attr('data-id')+"'><span id='lproduct_"+count+"'>"+$("#productid").val()+"</span>"
                qty.innerHTML = "<input type='hidden' id='qty_"+count+"' name='qty[]' value='"+$("#qty").val()+"'>"+$("#qty").val()
                unit.innerHTML = "<input type='hidden' id='unit_"+count+"' name='unit[]' value='"+$("#unit").val()+"'>"+$("#unit").select2().find(":selected").text()
                price.innerHTML = "<input type='hidden' id='price_"+count+"' name='price[]' value='"+$("#price").val()+"'>"+accounting.formatMoney($("#price").val(),'Rp ',0)
                discount.innerHTML = "<input type='hidden' id='discount_"+count+"' name='discount[]' value='"+$("#discount").val()+"'>"+$("#discount").val()
                pdiscount.innerHTML = "<input type='hidden' id='pdiscount_"+count+"' name='pdiscount[]' value='"+$("#pdiscount").val()+"'>"+$("#pdiscount").val()
                total.innerHTML = "<input type='hidden'  id='total_"+count+"'  price='"+$("#total").val()+"' class='total' name='total[]' value='"+$("#total").val()+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney($("#total").val(),'Rp ',0)+"</span>"
                action.innerHTML = actions
                hitung()
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)

            })
            $(document).on("click", '.delete',function(){
                rowindex = $(this).parents("tr").index();
                swal({
                    title: "Delete?",
                    text: "Data will be deleted?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary",
                    closeOnConfirm: true
                }, function (isConfirm) {
                    if(isConfirm) {
                        document.getElementById("tabledetail").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                        hitung()
                    }
                })
            })
            var form = $('#formPurchaser');
            $('#formPurchaser').validate();
            $(".btnSaveProduct").click(function(){
                var urls='{{route('salesTransaction.addData')}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formPurchaser').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data)
                            //alert(data.msg);
                            //location.reload();
                            swal({
                                    title: "Sales",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        location.href = '{{url('salesTransaction')}}'
                                    }
                                })
                            )
                        }
                    });
                }
            })
            $("#purchaseOrderId").change(function(){
                $("#tabledetail tbody").empty();
                price = $("#purchaseOrderId").select2().find(":selected").data("price")
                id = $("#purchaseOrderId").select2().find(":selected").data("id")
                $("#totalpurchaseorder").html( accounting.formatMoney(price,'Rp. ',0))
                var count = $('#tabledetail tbody tr').length;
                var valuetable =""
                $.get('{{url('api/salesOrder/getDetail/')}}/'+id,function(data){
                    console.log(data);
                    var data = data.msg;
                    var n =1;
                    for(var i in data)
                    {
                        valuetable = valuetable+"<tr>" +
                            "<td>"+ parseInt(n)+"</td>"+
                            "<td><input type='hidden' id='product_"+count+"' name='productid[]' value='"+data[i].id+"'><span id='lproduct_"+count+"'>"+data[i].code+" "+data[i].name+"</span></td>"+
                            "<td><input type='hidden' id='price_"+count+"' name='price[]' value='"+parseInt(data[i].price)+"'>"+ accounting.formatMoney(data[i].price,'Rp. ',0)+"</td>"+
                            "<td><input type='text' style='width: 18%;\n" +
                            " text-align: center;' readonly id='qty_"+count+"' name='qty[]' value='"+parseInt(data[i].qty)+"'></td>"+
                            "<td><input type='hidden' style='width: 18%;\n" +
                            " text-align: center;' readonly id='unit_"+count+"' name='unit[]' value='"+parseInt(data[i].unit_id)+"'>"+data[i].unitname+"</td>"+
                            "<td><input type='text'style='width: 18%;\\n\" +\n" +
                            "                            \" text-align: center;' readonly id='discount_"+count+"' name='discount[]' value='"+parseInt(data[i].discount)+"'></td>"+
                            "<td><input type='text'style='width: 18%;\\n\" +\n" +
                            "                            \" text-align: center;' readonly id='pdiscount_"+count+"' name='pdiscount[]' value='"+data[i].percent_discount+"'></td>"+
                            "<td><input type='hidden' id='total_"+count+"' class='total' price='"+parseInt(data[i].total)+"' name='total[]' value='"+parseInt(data[i].total)+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney(data[i].total,'Rp. ',0)+"</span></td>"+
                            "<td><button type='button'" +
                            "data-index='"+count+"'"+
                            "data-id='" + data[i].id + "'" +
                            "data-unitid='" + data[i].unit_id + "'" +
                            "data-value='" + data[i].code+"-" +data[i].name + "'" +
                            "data-price='" + data[i].price + "'" +
                            "data-qty='" + data[i].qty + "'" +
                            "data-discount='" + data[i].percent_discount + "'" +
                            "data-pdiscount='" + data[i].percent_discount + "'" +
                            "data-total='" + parseInt(data[i].total) + "'" +
                            "class='btn btn-info editPurchseOrder'><i class='icon-note'></i></button>" +
                            " <button data-index='"+count+"' data-id ='" + data[i].id + "' type='button' class='btn btn-danger delete'><i class='icon-trash'></i></button>"+ "</td></tr>"+
                            n++;
                        count++;
                    }
                    $("#tabledetail tbody").append(valuetable)
                    //console.log(valuetable)
                    hitung()
                })
            })

            function hitung() {
                var sum = 0;
                $('.total').each(function () {
                    sum += parseFloat($(this).attr('price'));
                });
                $("#sumtotal").html(accounting.formatMoney(sum,'Rp. ',0));
                $("#tsumtotal").val(sum);
                grandtotal()
            }

            $(".customerid").change(function () {
                $.get('{{url('vendor/getPaymentTermId')}}/'+$(this).select2().find(':selected').data('paymentterm'),function(data){
                    console.log(data.msg.name)
                    $("#payment_term_id").val(data.msg.id)
                    $(".paymentterm").html(data.msg.name)
                })
            })
        })
    </script>
@endsection