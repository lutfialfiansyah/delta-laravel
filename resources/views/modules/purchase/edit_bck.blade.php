@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.purchase') !!}</a>
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
     <form action="" id="formPProduct">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Purchase</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Purchase</label>
                                    <input type="text" required name="purchase_no" readonly value="{{$purchase->purchase_transaction_no}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input required type="text" id="date" required name="date" value="{{date('Y/m/d')}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <select required name="warehouse_id" id="warehouse_id" style="width: 100%"  class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($warehouse as $row)
                                            <option @if($purchase->warehouse_id==$row->id) selected @endif value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->

                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Purchase Order</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Purchase Order No</label>
                                    <select required name="purchase_order_id" style="width: 100%"  id="purchaseOrderId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($purchaseOrder as $row)
                                            <option @if($purchase->purchase_order_id==$row->id) selected @endif data-price="{{$row->total}}" data-id="{{$row->id}}" value="{{$row->id}}">{{$row->purchase_order_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Total Purchase Order</label>

                                        <span id="totalpurchaseorder" style="    font-size: 14px;" class="form-control">Rp. {{ number_format($purchase->purchaseOrder->total) }}</span>

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
                        <i class="fa fa-gift"></i>Vendor</div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <select required name="supplier_id" style="width: 100%"  id="purchaseSpId" class="form-control vendor select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($supplier as $row)
                                            <option @if($purchase->vendor_id==$row->id) selected @endif value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier Invoice</label>
                                    <input type="text" name="supplier_inv" value="{{$purchase->supplier_invoice_no}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Payment Term</label>
                                    <input type="hidden" id="payment_term_id" name="payment_term_id">
                                    <span class="form-control paymentterm" style="font-size:14px">{{$purchase->paymentTerm->name}}</span>
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
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Percent Discount</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                         @php
                            $no=1;
                        @endphp
                        @foreach($detail as $row)
                            <tr>
                                <td>{{$no}}</td>
                                <td id="name_{{$row->id}}">{{$row->code}}-{{$row->name}}</td>
                                <td id="price_{{$row->id}}">Rp {{number_format($row->price)}}</td>
                                <td id="qty_{{$row->id}}">{{$row->qty}}</td>
                                <td id="discount_{{$row->id}}">{{$row->discount}}</td>
                                <td id="pdiscount_{{$row->id}}">{{$row->percent_discount}}</td>
                                <td  class="total" price="{{$row->price*$row->qty}}" id="total_{{$row->id}}">Rp {{number_format($row->price*$row->qty)}}</td>
                                <td>
                                    <button type="button"
                                            data-in ="{{$row->idpd}}"
                                            data-id="{{$row->product_id}}"
                                            data-value="{{$row->code."-".$row->name}}"
                                            data-price="{{$row->price}}"
                                            data-qty="{{$row->qty}}"
                                            data-discount="{{$row->discount}}"
                                            data-pdiscount="{{$row->percent_discount}}"
                                            data-total="{{$row->price*$row->qty}}"
                                            class="btn btn-info editPurchseOrder"><i class="icon-note"></i></button>
                                    <button data-id ="{{$row->idpd}}" type="button" class="btn btn-danger delete"><i class="icon-trash"></i></button>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                        </tbody>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Shipping Method</label>
                                    <select required name="shopping_method" style="width: 100%"  id="purchaseSmId" class="form-control select2">
                                        <option value="" id="default">-----</option>
                                        @foreach($shippingMethod as $row)
                                            <option @if($purchase->delivery_type_id==$row->id) selected @endif value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Shipping Date</label>
                                    <input required type="text" name="shipping_date" id="shipping_date"  value="{{ $purchase->shipping_date }}" class="form-control shippingDate">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <input type="hidden" name="idpo" value="{{$purchase->id}}">
                                    <input required type="text" name="totalsum"  id="tsumtotal" value="{{ $purchase->total }}" class="form-control">
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
         <div class="modal fade" id="detailpurchaseorder" tabindex="-1" aria-labelledby="myModalLabel"  role="dialog" aria-hidden="true">
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
                                     <input type="hidden"name="product_id" id="psave">
                                     <input name=""  style="width: 100%"  id="productid" list="parentproduct" class="form-control datalistp">
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
                                     <label class="control-label">Discount</label>
                                     <input type="number" id="discount"  name="discount" value="0" class="form-control" placeholder="-">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label class="control-label">Percent Discount</label>
                                     <input type="number" id="pdiscount"  name="pdiscount" value="0" class="form-control" placeholder="-">
                                 </div>
                             </div>
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
    </form>
    <script type="text/javascript">
        $(function(){
            hitung()
            $(document).on("change", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
                $("#psave").val(datalist.attr('id'))
            })
            $(document).on("click", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                $("#price").val(parseInt(price))
                $('.datalistp').attr('data-id',datalist.attr('id'))
            })
            $(".addplusProd").click(function(){
                $("#detailpurchaseorder").modal();
                $(".btnall").html("<i class ='icon-plus'></i> Add")
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                $(".btnall").attr('data-id',0)
                $(".btnall").addClass('btnAddProduct')
                $(".btnall").removeClass('btneditProduct')
            })
            $('.editPurchseOrder').click(function () {
                $("#detailpurchaseorder").modal();
                $("#productid").val($(this).attr('data-value'))
                $("#psave").val($(this).attr('data-id'))
                $("#price").val(parseInt($(this).attr('data-price')));
                $("#qty").val($(this).attr('data-qty'));
                $("#discount").val($(this).attr('data-discount'));
                $("#pdiscount").val($(this).attr('data-pdiscount'));
                $("#total").val(parseInt($(this).attr('data-total')));
                $(".btnall").html("<i class ='icon-check'></i> Update")
                $(".btnall").removeAttr('data-id')
                $(".btnall").attr('data-id',$(this).attr('data-in'))
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
            $("#purchaseOrderId").change(function(){
                price = $("#purchaseOrderId").select2().find(":selected").data("price")
                id = $("#purchaseOrderId").select2().find(":selected").data("id")
                $("#totalpurchaseorder").html( accounting.formatMoney(price,'Rp. ',0))
                $(".totalpurchaseorder").attr('data-id',id)
            })
            $(".totalpurchaseorder").click(function () {
                $('#detailpurchaseorder').modal();
                $("#tabledetailmodel tbody").empty();
                var valuetable =""
                $.get('{{url('api/purchaseOrder/getDetail/')}}/'+$(this).attr('data-id'),function(data){
                    console.log(data);
                    var data = data.msg;

                    for(var i in data)
                    {
                        valuetable = valuetable+"<tr>" +
                            "<td>"+ parseInt(i)+1 +"</td>"+
                            "<td>"+ data[i].name+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].price,'Rp. ',0)+"</td>"+
                            "<td>"+ data[i].qty+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].discount,'Rp. ',0)+"</td>"+
                            "<td>"+ data[i].percent_discount+"</td>"+
                            "<td>"+ accounting.formatMoney(data[i].total,'Rp. ',0)+"</td>"+
                            "</tr>"
                    }
                    $("#tabledetailmodel tbody").append(valuetable)
                    //console.log(valuetable)
                })


            })
            var form = $('#formPProduct');
            $('#formPProduct').validate();
            $(".btnall").click(function () {
                id = $(this).attr('data-id');
                if(form.valid()) {
                    if (id == 0) {
                        var urls = '{{route('purchase.addProduct')}}';
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formPProduct').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                console.log(data.id)
                                $('#tabledetail tbody').append(
                                    "<tr>" +
                                    "<td>{{$no}}</td>" +
                                    "<td id='name_" + data.id + "'>" + $("#productid").val() + "</td>" +
                                    "<td id='price_" + data.id + "'>" + accounting.formatMoney($("#price").val(), 'Rp. ', 0) + "</td>" +
                                    "<td id='qty_" + data.id + "'>" + $("#qty").val() + "</td>" +
                                    "<td id='discount_" + data.id + "'>" + $("#discount").val() + "</td>" +
                                    "<td id='pdiscount_" + data.id + "'>" + $("#pdiscount").val() + "</td>" +
                                    "<td class='total' price='" + $("#total").val() + "' id='total_" + data.id + "'>" + accounting.formatMoney($("#total").val(), 'Rp. ', 0) + "</td>" +
                                    "<td >" +
                                    "<button type='button'" +
                                    "data-in ='" + data.id + "'" +
                                    "data-id='" + $("#productid").attr('data-id') + "'" +
                                    "data-value='" + $("#productid").val() + "'" +
                                    "data-price='" + $("#price").val() + "'" +
                                    "data-qty='" + $("#qty").val() + "'" +
                                    "data-discount='" + $("#discount").val() + "'" +
                                    "data-pdiscount='" + $("#pdiscount").val() + "'" +
                                    "data-total='" + $("#total").val() + "'" +
                                    "class='btn btn-info editPurchseOrder'><i class='icon-note'></i></button>" +
                                    " <button data-id ='" + data.id + "' type='button' class='btn btn-danger delete'><i class='icon-trash'></i></button>" +
                                    "</td>" +
                                    "</tr>"
                                );
                                hitung()
                            }
                        });
                    } else {
                        $("#total_" + id).html(accounting.formatMoney($("#total").val(), 'Rp. ', 0));
                        $("#name_" + id).html($("#productid").val());
                        $("#qty_" + id).html($("#qty").val());
                        $("#price_" + id).html(accounting.formatMoney($("#price").val(), 'Rp. ', 0));
                        $("#discount_" + id).html($("#discount").val());
                        $("#pdiscount_" + id).html($("#pdiscount").val());
                        $("#total_" + id).attr('price', $("#total").val());
                        var urls = '{{url('api/purchase/updateData/')}}/' + id;
                        hitung()
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formPProduct').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                console.log(data)
                                $("#tabdetail").focus();
                            }
                        });
                    }
                    $("#detailpurchaseorder").modal('hide');
                }
            })

            function hitung() {
                var sum = 0;
                $('.total').each(function () {
                    sum += parseFloat($(this).attr('price'));
                });
                $("#sumtotal").html(accounting.formatMoney(sum,'Rp. ',0));
                $("#tsumtotal").val(sum);
            }
             $(".btnSaveProduct").click(function () {
                $.post("{{ route('purchase.updateProduct',$purchase->id)}}",
                    {
                        sumtotal:$("#tsumtotal").val(),
                        warehouse_id:$("#warehouse_id").val(),
                        payment_term_id:$("#payment_term_id").val(),
                        purchase_order_id:$("#purchaseOrderId").val(),
                        delivery_id:$("#purchaseSmId").val(),
                        shipping_date:$("#shipping_date").val(),
                        supplier_id:$("#purchaseSpId").val()
                    },function(data){
                    console.log(data)
                    swal({
                        title: "Purchase",
                        text: 'Data has Updated!',
                        type: 'success',
                        confirmButtonClass: 'btn btn-success'
                    },(function(){

                            location.href = '{{url('purchase')}}'

                    })
                )
                });

            })
             $("button.delete").click(function () {
                //var cell = $(this).closest("tr").index(this);
                rowindex = $(this).parents("tr").index();
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
                                            url: '{{url('api/purchase/deleteProduct/')}}/'+id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                swal({
                                                        title: data.title,
                                                        text: data.msg,
                                                        type: data.type,
                                                        confirmButtonClass: 'btn btn-success'
                                                    },(function(){
                                                        document.getElementById("tabledetail").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                                                        hitung()
                                                        //location.reload()
                                                    })
                                                )
                                            }
                                        });
                                    }
                                }
                            )
                        })
            $(".vendor").change(function () {
                $.get('{{url('vendor/getPaymentTerm')}}/'+$(this).val(),function(data){
                    console.log(data.msg.name)
                    $("#payment_term_id").val(data.msg.id)
                    $(".paymentterm").html(data.msg.name)
                })
            })
        })
    </script>
@endsection
