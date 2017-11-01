@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('salesReturn.edit') !!}</a>
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
                                    <input type="text" name="purchase_return_no" readonly value="{{$salesReturn->purchase_return_no}}" class="form-control">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="date" required name="date" value="{{$salesReturn->date}}" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Warehouse</label>
                                    <select name="warehouse_id" style="width: 100%"  class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($warehouse as $row)
                                            <option @if($salesReturn->warehouse_id==$row->id) selected @endif value="{{$row->id}}">{{$row->code}}-{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <select name="supplier_id" style="width: 100%"  id="purchaseSpId" class="form-control select2">
                                        <option value="0" id="default">-----</option>
                                        @foreach($supplier as $row)
                                            <option @if($salesReturn->vendor_id==$row->id) selected @endif  value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
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
                        @php
                            $no=1;
                        @endphp
                        @foreach($detail as $row)
                            <tr>
                                <td>{{$no}}</td>
                                <td id="name_{{$row->id}}">{{$row->code}}-{{$row->name}}</td>
                                <td id="price_{{$row->id}}">Rp {{number_format($row->price)}}</td>
                                <td id="unit_{{$row->id}}">{{$row->unitname}}</td>
                                <td id="qty_{{$row->id}}">{{$row->qty}}</td>
                                <td  class="total" price="{{$row->total}}" id="total_{{$row->id}}">Rp {{number_format($row->total)}}</td>
                                <td>
                                    <button type="button"
                                            data-in ="{{$row->idpod}}"
                                            data-id="{{$row->product_id}}"
                                            data-price="{{$row->price}}"
                                            data-unitid ="{{$row->unit_id}}"
                                            data-value ="{{$row->code}}-{{$row->name}}"
                                            data-qty="{{$row->qty}}"
                                            data-total="{{$row->total}}"
                                            class="btn btn-info editPurchseReturn"><i class="icon-note"></i></button>
                                    <button class="btn btn-danger"><i class="icon-trash"></i></button>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
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
                        <i class="fa fa-gift"></i>Delivery type</div>
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
                                            <option @if($salesReturn->delivery_type_id==$row->id) selected @endif value="{{$row->id}}">{{$row->code}} -- {{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <input type="text" name="totalsum"  id="tsumtotal" value="{{$salesReturn->total}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Remark</label>
                                    <textarea name='remark' class='form-control'>{{$salesReturn->remarks}}</textarea>
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
                                    <input type="hidden" name="product_id" id="product_id">
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
            <input type="hidden" name="idpo" value="{{$salesReturn->id}}">
        </div>
    </form>
    <script type="text/javascript">
        $(function () {
            hitung()
            $(".addplusProd").click(function () {
                $(".btnall").removeAttr('data-id')
                $(".btnall").attr('data-id', 0)
                $(".btnall").html("<i class ='icon-plus'></i> Add")
                $("#detailpurchaseorder").modal();
                $("#qty").val(0)
                $(".datalistp").val()
                $("#price").val(0)
                $("#discount").val(0)
                $("#pdiscount").val(0)
                $("#productid").removeAttr('data-edit');
                $("#productid").attr('data-edit','false');
                $(".btnall").addClass('btnAddProduct')
                $(".btnall").removeClass('btneditProduct')
            })
            $(".select2").select2();
            function hitung() {
                var sum = 0;
                $('.total').each(function () {
                    sum += parseFloat($(this).attr('price'));
                });
                $("#sumtotal").html(accounting.formatMoney(sum,'Rp. ',0));
                $("#tsumtotal").val(sum);
            }
            $(document).on("change", '.datalistp',function(){
                unit_id = $(this).attr('data-unitid');
                val = $('.datalistp').val()
                datalist = $('#parentproduct [value="' + val + '"]')
                price =datalist.attr('data-price');
                id= datalist.attr('id');
                $('#product_id').val(id)
                $("#total").val(parseInt(price))
                $("#price").val(parseInt(price))
                $('.units').empty();
                $('.units').append('<option value="">---</option>');
                $.get('{{ url('api/productUnit/getProductUnit') }}/'+id,function(data){
                    console.log(data);
                    $.each(data.msg,function(index, value){
                        $('.units')
                            .append("<option value='"+value['unit_id']+"'>"+value['name']+"</option>");
                    });
                });
            })
            $("#qty").change(function(){
                total = $('#price').val()*$(this).val()
                $("#total").val(total)
            })
            $('.editPurchseReturn').click(function () {
                $(".btnall").html("<i class ='icon-check'></i> Update")
                $("#productid").attr('data-unitid',$(this).attr('data-unitid'));
                $("#productid").val($(this).attr('data-value'))
                $("#productid").attr('data-id',$(this).attr('data-id'));
                $("#product_id").val($(this).attr('data-id'));
                $("#price").val(parseInt($(this).attr('data-price')));
                $("#qty").val($(this).attr('data-qty'));
                $("#total").val(parseInt($(this).attr('data-total')));
                $("#detailpurchaseorder").modal();
                $(".btnall").removeAttr('data-id')
                $(".btnall").attr('data-id',$(this).attr('data-in'))
                $(".btnall").attr('data-id',$(this).attr('data-in'))
                $(".btnall").attr('data-index',$(this).attr('data-index'))
            })
            $(".btncancel").click(function () {
                $("#tabproducts").fadeOut();
            })
            $(".btnall").click(function () {
                id = $(this).attr('data-id');
                if(id==0){
                    $("#tabdetail").focus();
                    var urls='{{route('salesReturn.addProduct')}}';
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formPurchaser').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data.id)
                            $('#tabledetail tbody').append(
                                "<tr>"+
                                "<td>{{$no}}</td>"+
                                "<td id='name_" + data.id+ "'>"+$("#productid").val()+"</td>"+
                                "<td id='price_" + data.id+ "'>"+accounting.formatMoney($("#price").val(),'Rp. ',0)+"</td>"+
                                "<td id='unit_" + data.id+ "'>"+$("#unit_id").select2().find(":selected").text()+"</td>"+
                                "<td id='qty_" + data.id+ "'>"+$("#qty").val()+"</td>"+
                                "<td class='total' price='"+$("#total").val()+"' id='total_" + data.id+ "'>"+accounting.formatMoney($("#total").val(),'Rp. ',0)+"</td>"+
                                "<td >"+
                                "<button type='button'"+
                                "data-in ='"+data.id+"'"+
                                "data-id='"+$("#productid").attr('data-id')+"'"+
                                "data-value='"+$("#productid").val()+"'"+
                                "data-price='"+$("#price").val()+"'"+
                                "data-qty='"+$("#qty").val()+"'"+
                                "data-unitid='"+$("#unitid").val()+"'"+
                                "data-total='"+$("#total").val()+"'"+
                                "class='btn btn-info editPurchseOrder'><i class='icon-note'></i></button>"+
                                "</td>"+
                                "</tr>"
                            );
                            hitung()
                        }
                    });
                }else{
                    $("#total_"+id).html(accounting.formatMoney($("#total").val(),'Rp. ',0));
                    $("#name_"+id).html($("#productid option:selected").text());
                    $("#qty_"+id).html($("#qty").val());
                    $("#price_"+id).html(accounting.formatMoney($("#price").val(),'Rp. ',0));
                    $("#unit_"+id).html($("#unitid option:selected").text());
                    $("#total_"+id).attr('price',$("#total").val());
                    var urls='{{url('api/salesReturn/updateData/')}}/'+id;
                    hitung()
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formPurchaser').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data)
                            $("#tabdetail").focus();
                        }
                    });
                }
                $("#detailpurchaseorder").modal('hide');
            })
            $(".btnSaveProduct").click(function () {
                $.post("{{ route('salesReturn.updateProduct',$salesReturn->id)}}", $('#formPurchaser').serialize(),function(data){
                    console.log(data)
                    swal({
                            title: "Sales",
                            text: 'Data has Updated!',
                            type: 'success',
                            confirmButtonClass: 'btn btn-success'
                        },(function(){

                            location.href = '{{url('salesReturn')}}'

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
                        text: "Data will be deleted on database?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '{{url('api/purchaseOrder/deleteProduct/')}}/'+id,
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
        })
    </script>
@endsection