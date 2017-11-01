@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.purchase') !!}</a>
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
                                    <input type="text" name="purchase_no" readonly value="{{$code}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="date" required name="date" value="{{date('Y/m/d')}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Branch </label>
                                    <select  required class="form-control select2" id="branch" style="width:100%" name="branch">
                                        <option value="">Choose a branch</option>
                                        @foreach($branch as $row)
                                            <option value="{{$row->id}}">{{$row->description}}</option>
                                        @endforeach
                                    </select>
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
                                            <option data-price="{{$row->total}}" data-id="{{$row->id}}" value="{{$row->id}}">{{$row->purchase_order_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Total Purchase Order</label>
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
                                        <option value="" id="default">-----</option>
                                        @foreach($supplier as $row)
                                            <option value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier Invoice</label>
                                    <input type="text" name="supplier_inv"  class="form-control">
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
                            <th >Qty</th>
                            <th >Unit</th>
                            <th>Discount</th>
                            <th>Percent Discount</th>
                            <th>Sub Total</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7"></td>
                            <td><span id="sumtotal"></span></td>
                            <td><span id="sumtax"></span></td>
                            <td><span id="sumtotaltax"></span></td>
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
                        <i class="fa fa-gift"></i>Additional </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Additional Discount</label>
                                    <input type="text" id="additional_discount" name="additional_discount"  value="0" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Additional Cost</label>
                                    <input type="text" id="additional_cost" name="additional_cost"  value="0" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Sub Total</label>
                                    <input type="text" id="grand_total" name="grand_total"  value="0" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Grand Total With Tax</label>
                                    <input type="text" id="grand_total_w_tax" name="grand_total_w_tax"  value="0" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Shipping Date</label>
                                    <input type="text" required name="shipping_date"  value="" class="form-control shippingDate">
                                </div>
                            </div>
                            <input type="hidden" required name="totalsum"  id="tsumtotal" value="0" class="form-control">
                            <input type="hidden" required name="totalsumtax"  id="tsumtotaltax" value="0" class="form-control">
                            <input type="hidden" required name="tsumqty"  id="tsumqty" value="0" class="form-control">

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
                                <label class="control-label">Price <input id="include" type="checkbox">include tax
                                </label>
                                <input type="number" id="price"  name="" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Qty</label>
                                <input type="number" id="qty"  name="" value="0" class="form-control" placeholder="-">
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
                                <input type="number" id="discount"  name="" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Percent Discount</label>
                                <input type="number" id="pdiscount"  name="" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Tax</label>
                                <select name="" class="form-control tax">
                                    <option rate="0" value="">Choose a tax</option>
                                    @foreach($tax as $row)
                                        <option rate="{{$row->rate}}" value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Sub Total</label>
                                <input type="text" id="total"  name="total" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Total Tax</label>
                                <input type="text" id="totaltax" name="totaltax" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Total</label>
                                <input type="text" id="total_with_tax" name="total_with_tax" class="form-control">
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
            function tax(){
                includetax()
                var total = $("#total").val();
                var rate = $(".tax option:selected").attr('rate');
                var totaltax = parseFloat(total*((parseInt(rate)+100)/100)).toFixed(2);
                $('#total_with_tax').val((totaltax));
                $('#totaltax').val(parseFloat(totaltax-total).toFixed(2))
            }
            function includetax(){
                total = $('#price').val()*$('#qty').val()-$('#discount').val()
                pdiscount = (total *$('#pdiscount').val())/100
                ttotal = total- pdiscount;
                if(document.getElementById('include').checked){
                    var totaltax = ttotal/1.1;
                    $("#total").val(parseFloat(totaltax).toFixed(2))
                }else{
                    $("#total").val(parseFloat(ttotal).toFixed(2))
                }
            }
            function grandTotal() {
                var total = $("#tsumtotal").val();
                var tax = $("#tsumtotaltax").val();
                var additional_discount = $("#additional_discount").val();
                var additional_cost = $("#additional_cost").val();
                var grandtotal = parseFloat(total)+ parseFloat(additional_cost)-parseFloat(additional_discount);
                $("#grand_total").val(parseFloat(grandtotal).toFixed(2))
                $("#grand_total_w_tax").val(parseFloat(parseFloat(grandtotal)+parseFloat(tax)).toFixed(2))
            }
            $(document).on("change", '#include',function(){
                tax()
            })
            $(document).on("change", '.tax',function(){
                tax()
            })
            $("#additional_discount").keyup( function(){
                grandTotal()
            })
            $("#additional_cost").keyup( function(){
                grandTotal()
            })
            $("#tsumtotal").change(function () {
                grandTotal()
            })
            $(document).on("change", '.datalistp',function(){
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                //$("#price").val(parseInt(price))
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
                //$("#price").val(parseInt(price))
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
                $("#productid").val('').trigger('change')
                $(".tax").val('').trigger('change')
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                $("#totaltax").val(0)
                $("#total_with_tax").val(0)
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
            $("#price").change(function(){
                total = parseInt($('#price').val()) * $('#qty').val()
                $("#total").val(total)
                tax()
            })
            $("#qty").change(function(){
                total = $('#price').val()*$(this).val()
                $("#total").val(total)
                tax()
            })
            $("#discount").change(function(){
                total = $('#price').val()*$('#qty').val()
                $("#total").val(total- $(this).val())
                tax()
            })
            $("#pdiscount").change(function(){
                total = $('#price').val()*$('#qty').val()-$('#discount').val()
                pdiscount = (total * $(this).val())/100
                $("#total").val(total- pdiscount)
                tax()
            })
            var sumtotal=0;
            $(document).on("click", '.editPurchseOrder',function(){
                $(".btnall").removeAttr('index')
                var index = $(this).attr('data-index')
                $(".btnall").attr('index',index)
                $(".btnall").html("<i class ='icon-check'></i> Update")
                var id = $(this).attr('data-id')
                var value = $(this).attr('data-value')
                var uid = $(this).attr('data-unit')
                var tuid = $(this).attr('data-unitname')
                var tax_id = $(this).attr('data-taxid')
                var price = parseInt($(this).attr('data-price'))
                var qty = $(this).attr('data-qty')
                var discount = $(this).attr('data-discount')
                var pdiscount = $(this).attr('data-pdiscount')
                var total = $(this).attr('data-total')
                var totaltax = $(this).attr('data-totaltax')
                var totalwtax = $(this).attr('data-totalwtax')
                $("#qty").val(qty);
                $("#price").val(price);
                $("#discount").val(discount);
                $("#pdiscount").val(pdiscount);
                $("#total").val(total);
                $("#totaltax").val(totaltax);
                $("#total_with_tax").val(totalwtax);
                //
                $("#detailpurchaseorder").modal();
                $("#productid").val(value).trigger('change')
                $("#unitid").append('<option value="'+uid+'" selected>'+tuid+'</option>');
                //$("#unitid").val(uid).trigger('change')
                $(".tax").val(tax_id).trigger('change')
                $(".btnall").removeClass('btnAddProduct')
                $(".btnall").addClass('btneditProduct')

            })
            $(document).on("click", '.btneditProduct',function(){
                $("#qty_"+$(this).attr('index')).val($("#qty").val());
                $("#lqty_"+$(this).attr('index')).html($("#qty").val());
                $("#unitid_"+$(this).attr('index')).val($("#unitid").val());
                $("#lunit_"+$(this).attr('index')).html($("#unitid option:selected").text());
                $("#product_"+$(this).attr('index')).val($("#productid").attr('data-id'));
                $("#lproduct_"+$(this).attr('index')).html($("#productid").val());
                $("#price_"+$(this).attr('index')).val($("#price").val());
                $("#discount_"+$(this).attr('index')).val($("#discount").val());
                $("#ldiscount_"+$(this).attr('index')).html(accounting.formatMoney($("#discount").val(),'{{ Session::get('symbol')}}',2));
                $("#pdiscount_"+$(this).attr('index')).val($("#pdiscount").val());
                $("#lpdiscount_"+$(this).attr('index')).html($("#discount").val());
                $("#tax_"+$(this).attr('index')).val($("#totaltax").val());
                $("#tax_"+$(this).attr('index')).attr('price',$("#totaltax").val());
                $("#totaltax_"+$(this).attr('index')).val($("#total_with_tax").val());
                $("#totaltax_"+$(this).attr('index')).attr('price',$("#total_with_tax").val());
                $("#total_"+$(this).attr('index')).val($("#total").val());
                $("#total_"+$(this).attr('index')).attr('price',$("#total").val());
                $("#ltotal_"+$(this).attr('index')).html(accounting.formatMoney($("#total").val(),'{{ Session::get('symbol')}}',2));
                $("#ltax_"+$(this).attr('index')).html(accounting.formatMoney($("#totaltax").val(),'{{ Session::get('symbol')}}',2));
                $("#ltotaltax_"+$(this).attr('index')).html(accounting.formatMoney($("#total_with_tax").val(),'{{ Session::get('symbol')}}',2));
                $("#detailpurchaseorder").modal('hide');
                $("#btn_"+$(this).attr('index')).attr('data-qty',$("#qty").val())
                $("#btn_"+$(this).attr('index')).attr('data-discount',$("#discount").val())
                $("#btn_"+$(this).attr('index')).attr('data-pdiscount',$("#pdiscount").val())
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
                var tax = row.insertCell(8)
                var totaltax = row.insertCell(9)
                var action = row.insertCell(10)
                var actions ="<button type='button'" +
                    "data-id='" + $("#productid").attr('data-id') + "'" +
                    "data-value='" + $("#productid").val() + "'" +
                    "data-index='" + count + "'" +
                    "data-unit='"+$("#unitid").val()+"'"+
                    "data-unitname='"+$("#unitid option:selected").text()+"'"+
                    "data-price='" + $("#price").val() + "'" +
                    "data-qty='" + $("#qty").val() + "'" +
                    "data-discount='" + $("#discount").val() + "'" +
                    "data-pdiscount='" + $("#pdiscount").val() + "'" +
                    "data-total='" + $("#total").val() + "'" +
                    "data-totaltax='"+$("#totaltax").val()+"'"+
                    "data-taxid='"+$(".tax").val()+"'"+
                    "data-totalwtax='"+$("#total_with_tax").val()+"'"+
                    "class='btn btn-info editPurchseOrder' " +
                    "id ='btn_"+count+"'><i class='icon-note'></i></button>" +
                    "<button type='button' data-index='"+count+"' class='btn btn-danger delete'><i class='icon-trash'></i></button>";
                no.innerHTML=count+1
                productName.innerHTML = "<input type='hidden' id='product_"+count+"' name='productid[]' value='"+$("#productid").attr('data-id')+"'><span id='lproduct_"+count+"'>"+$("#productid").val()+"</span>"
                qty.innerHTML = "<input type='hidden' class='qty' id='qty_"+count+"' name='qty[]' value='"+$("#qty").val()+"'><span id='lqty_"+count+"'>"+$("#qty").val()+"</span>"
                unit.innerHTML = "<input type='hidden' name='unitid["+count+"]' value='"+$("#unitid").val()+"'><span id='lunit_"+count+"'>"+$("#unitid option:selected").text()+"</span>"
                price.innerHTML = "<input type='hidden' id='price_"+count+"' name='price[]' value='"+$("#price").val()+"'>"+accounting.formatMoney($("#price").val(),'{{ Session::get('symbol')}}',2)
                discount.innerHTML = "<input type='hidden' id='discount_"+count+"' name='discount[]' value='"+$("#discount").val()+"'><span id='ldiscount_"+count+"'>"+parseFloat($("#discount").val()).toFixed(2)+"</span>"
                pdiscount.innerHTML = "<input type='hidden' id='pdiscount_"+count+"' name='pdiscount[]' value='"+$("#pdiscount").val()+"'>"+$("#pdiscount").val()
                total.innerHTML = "<input type='hidden'  id='total_"+count+"'  price='"+$("#total").val()+"' class='total' name='total[]' value='"+$("#total").val()+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney($("#total").val(),'{{ Session::get('symbol')}}',2)+"</span>"
                action.innerHTML = actions
                tax.innerHTML = "<input type='hidden' class='ttax' id='tax_"+count+"' name='tax[]' price='"+$("#totaltax").val()+"' value='"+$(".tax").val()+"'>"+accounting.formatMoney($("#totaltax").val(),'{{ Session::get('symbol')}}',2)
                totaltax.innerHTML="<input type='hidden' class='totaltax' price='"+$("#total_with_tax").val()+"' id='totaltax_"+count+"' name='totaltax[]' value='"+$("#totaltax").val()+"'>"+accounting.formatMoney($("#total_with_tax").val(),'{{ Session::get('symbol')}}',2)
                hitung()
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                $("#totaltax").val(0)
                $("#total_with_tax").val(0)

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
                var urls='{{route('purchase.addData')}}';
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
                            //exit;
                            swal({
                                    title: "Purchase",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        location.href = '{{url('purchase')}}'
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
                $("#totalpurchaseorder").html( accounting.formatMoney(price,'{{ Session::get('symbol')}}',2))
                var count = $('#tabledetail tbody tr').length;
                var valuetable =""
                $.get('{{url('api/purchaseOrder/getDetail/')}}/'+id,function(data){
                    console.log(data);
                    var data = data.msg;
                    var n =1;
                    for(var i in data)
                    {
                        valuetable = valuetable+"<tr>" +
                            "<td>"+ parseInt(n)+"</td>"+
                            "<td><input type='hidden' id='product_"+count+"' name='productid[]' value='"+data[i].id+"'><span id='lproduct_"+count+"'>"+data[i].code+" "+data[i].name+"</span></td>"+
                            "<td><input type='hidden' id='price_"+count+"' name='price[]' value='"+parseInt(data[i].price)+"'>"+ accounting.formatMoney(data[i].price,'{{ Session::get('symbol')}}',2)+"</td>"+
                            "<td style='width:15px'><input type='hidden' class='qty' style='background-color: transparent;border: none;;\n" +
                            " text-align: center;' readonly id='qty_"+count+"' name='qty[]' value='"+parseInt(data[i].qty)+"'><span id='lqty_"+count+"'>"+parseInt(data[i].qty)+"</span></td>"+
                            "<td style='width:15px'><input type='hidden' style='    border: none;\n" +
                            "    background-color: transparent;width:15px' class='form-control' readonly id='unit_"+count+"' name='unitid[]' value='"+data[i].unitid+"'>"+data[i].unitname+"</td>"+
                            "<td style='width:20px'><input type='hidden'style='background-color: transparent;border: none;text-align: center;' readonly id='discount_"+count+"' name='discount[]' value='"+parseInt(data[i].discount)+"'><span id='ldiscount_"+count+"'>"+parseInt(data[i].discount)+"</span></td>"+
                            "<td style='width:20px'><input type='text'style='background-color: transparent;border: none;text-align: center;' readonly id='pdiscount_"+count+"' name='pdiscount[]' value='"+data[i].percent_discount+"'></td>"+
                            "<td><input type='hidden' id='total_"+count+"' class='total' price='"+data[i].total+"' name='total[]' value='"+data[i].total+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney(data[i].total,'{{ Session::get('symbol')}}',2)+"</span></td>"+
                            "<td><input type='hidden' id='tax_"+count+"' class='ttax' price='0.00' name='tax[]' value='0.00'><span id='ltax_"+count+"'>"+accounting.formatMoney(0,'{{ Session::get('symbol')}}',2)+"</span></td>"+
                            "<td><input type='hidden' id='totaltax_"+count+"' class='totaltax' price='"+data[i].total+"' name='totaltax[]' value='"+data[i].total+"'><span id='ltotaltax_"+count+"'>"+accounting.formatMoney(data[i].total,'{{ Session::get('symbol')}}',2)+"</span></td>"+
                            "<td><button type='button'" +
                            "data-index='"+count+"'"+
                            "data-id='" + data[i].id + "'" +
                            "data-value='" + data[i].code+"-" +data[i].name + "'" +
                            "data-price='" + data[i].price + "'" +
                            "data-qty='" + data[i].qty + "'" +
                            "data-unit='" + data[i].unitid + "'" +
                            "data-unitname='" + data[i].unitname + "'" +
                            "data-discount='" + data[i].percent_discount + "'" +
                            "data-pdiscount='" + data[i].percent_discount + "'" +
                            "data-total='" + parseInt(data[i].total) + "'" +
                            "class='btn btn-info editPurchseOrder' id='btn_"+count+"'><i class='icon-note'></i></button>" +
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
                var sumqty = 0;
                var sumtax = 0;
                var sumttax = 0;
                $('.total').each(function () {
                    sum += parseFloat($(this).attr('price'));
                });
                $('.qty').each(function () {
                    sumqty += parseFloat($(this).val());
                });
                $('.ttax').each(function () {
                    sumtax += parseFloat($(this).attr('price'));
                });
                $('.totaltax').each(function () {
                    sumttax += parseFloat($(this).attr('price'));
                });
                $("#sumtotal").html(accounting.formatMoney(sum,'{{ Session::get('symbol')}}',2));
                $("#sumtax").html(accounting.formatMoney(sumtax,'{{ Session::get('symbol')}}',2));
                $("#sumtotaltax").html(accounting.formatMoney(sumttax,'{{ Session::get('symbol')}}',2));
                $("#tsumtotal").val(sum).trigger('change');
                $("#tsumtotaltax").val(sumtax).trigger('change');
                $("#tsumqty").val(sumqty).trigger('change');
                grandTotal()
            }

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