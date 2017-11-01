@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.purchaseReturn') !!}</a>
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
                                    <input type="text" name="purchase_return_no" readonly value="{{$code}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="date" readonly required name="date" value="{{date('Y/m/d')}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <select  required class="form-control select2" id="branch" style="width:100%" name="branch">
                                        <option value="">Choose a branch</option>
                                        @foreach($branch as $row)
                                            <option value="{{$row->id}}">{{$row->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <select name="warehouse_id" style="width: 100%"  class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($warehouse as $row)
                                            <option value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <select name="supplier_id" style="width: 100%"  id="purchaseSpId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($supplier as $row)
                                            <option value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Detail</div>
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
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td  bgcolor="#a9a9a9" colspan="5"></td>
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Delivery type</label>
                                    <select name="shopping_method" style="width: 100%"  id="purchaseSmId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($shippingMethod as $row)
                                            <option value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                    <input type="hidden" name="totalsum"  id="tsumtotal" value="" class="form-control">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Remark</label>
                                    <textarea name='remark' class='form-control'></textarea>
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
                                <select style="font-size: 14px" name="" id="unitid" class="form-control unit">
                                    <option value="0" id="default">-----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Discount</label>
                                <input type="number" id="discount"  name="" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Percent Discount</label>
                                <input type="number" id="pdiscount"  name="" value="0" class="form-control" placeholder="-">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Total</label>
                                <input type="text" id="total"  name="" value="0" class="form-control" placeholder="-">
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
                $("#unit_"+$(this).attr('index')).val($("#unitid").val());
                $("#lunit_"+$(this).attr('index')).html($("#unitid").select2().find(":selected").text());
                $("#price_"+$(this).attr('index')).val($("#price").val());
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
                var unit = row.insertCell(3)
                var qty = row.insertCell(4)
                var total = row.insertCell(5)
                var action = row.insertCell(6)
                var actions ="<button type='button'" +
                    "data-id='" + $("#productid").attr('data-id') + "'" +
                    "data-value='" + $("#productid").val() + "'" +
                    "data-index='" + count + "'" +
                    "data-price='" + $("#price").val() + "'" +
                    "data-qty='" + $("#qty").val() + "'" +
                    "data-total='" + $("#total").val() + "'" +
                    "class='btn btn-info editPurchseOrder' ><i class='icon-note'></i></button>" +
                    "<button type='button' class='btn btn-danger delete'><i class='icon-trash'></i></button>";
                no.innerHTML=count+1
                productName.innerHTML = "<input type='hidden' id='product_"+count+"' name='productid[]' value='"+$("#productid").attr('data-id')+"'><span id='lproduct_"+count+"'>"+$("#productid").val()+"</span>"
                qty.innerHTML = "<input type='hidden' id='qty_"+count+"' name='qty[]' value='"+$("#qty").val()+"'>"+$("#qty").val()
                unit.innerHTML = "<input type='hidden' id='unit_"+count+"' name='unitid[]' value='"+$("#unitid").val()+"'><span id='lunit_"+count+"'>"+$("#unitid").select2().find(":selected").text()+"</span>"
                price.innerHTML = "<input type='hidden' id='price_"+count+"' name='price[]' value='"+$("#price").val()+"'>"+accounting.formatMoney($("#price").val(),'Rp ',0)
                total.innerHTML = "<input type='hidden'  id='total_"+count+"'  price='"+$("#total").val()+"' class='total' name='total[]' value='"+$("#total").val()+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney($("#total").val(),'Rp ',0)+"</span>"
                action.innerHTML = actions
                hitung()
                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)

            })
            var form = $('#formPurchaser');
            $('#formPurchaser').validate();
            $(".btnSaveProduct").click(function(){
                var urls='{{route('purchaseReturn.addData')}}';
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
                                    title: "Purchase",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        location.href = '{{url('purchaseReturn')}}'
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
                $.get('{{url('api/purchaseOrder/getDetail/')}}/'+id,function(data){
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
                            "<td><input type='text'style='width: 18%;\\n\" +\n" +
                            "                            \" text-align: center;' readonly id='discount_"+count+"' name='discount[]' value='"+parseInt(data[i].discount)+"'></td>"+
                            "<td><input type='text'style='width: 18%;\\n\" +\n" +
                            "                            \" text-align: center;' readonly id='pdiscount_"+count+"' name='pdiscount[]' value='"+data[i].percent_discount+"'></td>"+
                            "<td><input type='hidden' id='total_"+count+"' class='total' price='"+parseInt(data[i].total)+"' name='total[]' value='"+parseInt(data[i].total)+"'><span id='ltotal_"+count+"'>"+accounting.formatMoney(data[i].total,'Rp. ',0)+"</span></td>"+
                            "<td><button type='button'" +
                            "data-index='"+count+"'"+
                            "data-id='" + data[i].id + "'" +
                            "data-value='" + data[i].code+"-" +data[i].name + "'" +
                            "data-price='" + data[i].price + "'" +
                            "data-qty='" + data[i].qty + "'" +
                            "data-discount='" + data[i].percent_discount + "'" +
                            "data-pdiscount='" + data[i].percent_discount + "'" +
                            "data-total='" + parseInt(data[i].total) + "'" +
                            "class='btn btn-info editPurchseOrder'><i class='icon-note'></i></button>" +
                            " <button data-id ='" + data.id + "' type='button' class='btn btn-danger delete'><i class='icon-trash'></i></button>"+ "</td></tr>"+
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