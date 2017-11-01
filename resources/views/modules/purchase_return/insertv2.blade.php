@extends('layout.layout_dashboard')
@section('content')
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
                                    <input type="text" id="date" required name="date" value="{{date('Y/m/d')}}" class="form-control" placeholder="-">

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
                                    <label class="control-label">Shipping Method</label>
                                    <select name="shopping_method" style="width: 100%"  id="purchaseSmId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($shippingMethod as $row)
                                            <option value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <input type="text" name="totalsum"  id="tsumtotal" value="" class="form-control">
                                </div>
                            </div>
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
                                <select style="font-size: 14px" name="unit_id" id="unitid" class="form-control unit">
                                    <option value="0" id="default">-----</option>
                                </select>
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
    <script type="text/javascript">
        $(function(){
            $(".shippingDate").datepicker(
                {
                    autoclose:true,
                    format: 'yyyy/mm/dd'
                }
            )
            $(".select2").select2()
            $("#productid").change(function(){
                id= $(this).val();
                price =  $("#productid").select2().find(':selected').data("price");
                // alert(price);
                $("#price").val(parseInt(price))
                $("#qty").val(1)
                $("#total").val(parseInt(price))
                $('.unit').empty();
                $('.unit').append('<option value="">---</option>');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.unit')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })
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
            $(".btnAddProduct").click(function(){
                if($("#productid").val()==0){
                    swal("Product Can't Empty")
                    exit;
                }
                var count = $('#tabledetail tbody tr').length;
                var table = document.getElementById("tabledetail").getElementsByTagName('tbody')[0];
                var row = table.insertRow(count)
                var no = row.insertCell(0)
                var productName = row.insertCell(1)
                var price = row.insertCell(2)
                var unit = row.insertCell(3)
                var qty = row.insertCell(4)
                var total = row.insertCell(5)
                no.innerHTML=count+1
                productName.innerHTML = "<input type='hidden' name='productid["+count+"]' value='"+$("#productid").val()+"'>"+$("#productid option:selected").text()
                unit.innerHTML = "<input type='hidden' name='unitid["+count+"]' value='"+$("#unitid").val()+"'>"+$("#unitid option:selected").text()
                qty.innerHTML = "<input type='hidden' name='qty["+count+"]' value='"+$("#qty").val()+"'>"+$("#qty").val()
                price.innerHTML = "<input type='hidden' name='price["+count+"]' value='"+$("#price").val()+"'>"+accounting.formatMoney($("#price").val(),'Rp ',0)
                total.innerHTML = "<input type='hidden' name='total["+count+"]' value='"+$("#total").val()+"'>"+accounting.formatMoney($("#total").val(),'Rp ',0)
                sumtotal = parseInt(sumtotal)+parseInt($("#total").val());
                $("#sumtotal").html(accounting.formatMoney(sumtotal,'Rp ',0));
                $("#tsumtotal").val(sumtotal);

                $("#qty").val(0)
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#total").val(0)
                document.getElementById("default").selected;
                $("#productid").select2('val','0')
            })
            $(".btnSaveProduct").click(function(){
                var urls='{{route('purchaseReturn.addData')}}';
                $.ajax({
                    url: urls,
                    type: 'POST',
                    data: $('#formPurchaser').serialize(),
                    datatype: 'json',
                    success: function (data) {
                        console.log(data)
                        //alert(data.msg);
                        exit;
                        //location.reload();
                        swal({
                                title: "Purchase",
                                text: data.msg,
                                type: data.type,
                                confirmButtonClass: 'btn btn-success'
                            },(function(){
                                if(data.status=true) {
                                    location.href = '{{url('purchaseReturn')}}'
                                }
                            })
                        )
                    }
                });
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
        })
    </script>
@endsection