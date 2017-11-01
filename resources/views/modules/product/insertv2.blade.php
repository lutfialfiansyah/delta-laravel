@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.product') !!}</a>
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
    <form action="" id="formproduct" method="post" class="horizontal-form">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            {{--<small>statistics, charts, recent events and reports</small>--}}
        </h1>
        <!-- END PAGE TITLE-->
        <div class="tab-pane" id="tab_1">
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-8">
                                <span style="font-size: 20px;">Add New Product</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">General Information</a>
                    </li>
                </ul>
                <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body form">


                                <div class="row" style="margin-top:10px; ">
                                    <div class="col-sm-6">
                                        <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4">Item No.</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                        <input type="text" name="item_no" readonly value="{{$itemno}}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 13px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Product Code</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                        <input type="text" id=""   name="code" value="{{ $code }}" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Product Name</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                        <input type="text" id=""  name="name" value="" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Type</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                    <span class="input-group-addon" style="cursor: pointer;" id="stype"><i class="fa fa-search"></i></span>
                                                <input type="text" id="ttype" placeholder="-" class="form-control">
                                                <input type="hidden" name="type_id" id="type" placeholder="-" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Brand</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                    <span class="input-group-addon" style="cursor: pointer;" id="sbrand"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tbrand" placeholder="-" class="form-control">
                                                <input type="hidden" name="brand_id" id="brand" placeholder="-" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Category</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width:100%;">
                                                       <span class="input-group-addon" style="cursor: pointer;" id="scategory"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tcategory" placeholder="-" class="form-control category">
                                                <input type="hidden" name="category_id" id="category" placeholder="-" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Sub Category</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                        <span class="input-group-addon" style="cursor: pointer;" id="ssubcategory"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tsubcategory" placeholder="-" class="form-control subcategory">
                                                <input type="hidden" name="sub_cat_id" id="subcategory" placeholder="-" class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-4">Group</label>
                                                <div class="col-md-6">
                                                    <div class="input-group" style="width: 100%;">
                                                       <span class="input-group-addon" style="cursor: pointer;" id="sprodgroup"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tprodgroup" placeholder="-" class="form-control">
                                                <input type="hidden" name="group_id" id="prodgroup" placeholder="-" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
        <div class="tab-pane" id="tab_1" style="margin-top: 10px;">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Unit Conversion</a>
                    </li>
                </ul>
                <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px; height: 300px;">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body form">


                                <div class="row" style="margin-top:10px;margin-left: 10px;">
                                    <div class="form-group">
                                        <label class="control-label  col-sm-2">Unit</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                               <span class="input-group-addon" style="cursor: pointer;" id="sunit"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tunit" placeholder="search" class="form-control">
                                                <input type="hidden" name="unit_id" id="unit" placeholder="search" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:13px;margin-left: 10px;">
                                    <div class="form-group">
                                        <label class="control-label  col-sm-2">Unit 2</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-addon" style="cursor: pointer;" id="sunit2"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tunit2" placeholder="search" class="form-control">
                                                <input type="hidden" name="unit_2_id" id="unit2" placeholder="search" class="form-control">
                                            </div>
                                        </div>
                                        <label class="control-label bold">PCS</label>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <input type="text" id="unit2qty"  name="unit_2_qty" value="" class="form-control" placeholder="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-2">Unit 3</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                          <span class="input-group-addon" style="cursor: pointer;" id="sunit3"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tunit3" placeholder="search" class="form-control">
                                                <input type="hidden" name="unit_3_id" id="unit3" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                                <label class="control-label bold">PCS</label>
                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <input type="text" id="unit3qty" name="unit_3_qty" value="" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-2">Unit 4</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                          <span class="input-group-addon" style="cursor: pointer;" id="sunit4"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tunit4" placeholder="search" class="form-control">
                                                <input type="hidden" name="unit_4_id" id="unit4" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                                <label class="control-label bold">PCS</label>
                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <input type="text" id="unit4qty"  name="unit_4_qty" value="" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-2">Unit 5</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                          <span class="input-group-addon" style="cursor: pointer;" id="sunit5"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tunit5" placeholder="search" class="form-control">
                                                <input type="hidden" name="unit_5_id" id="unit5" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                                <label class="control-label bold">PCS</label>
                                                <div class="col-md-2">
                                                    <div class="input-group">
                                                        <input type="text" id="unit5qty"  name="unit_5_qty" value="" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

                <div class="col-md-6">
        <div class="tab-pane" id="tab_1" style="margin-top: 10px;">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Product COA</a>
                    </li>
                </ul>
                <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px; height: 300px;">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body form">


                                <div class="row" style="margin-top:10px;margin-left: 10px;">
                                    <div class="form-group">
                                        <label class="control-label  col-sm-5">Stock</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                               <span class="input-group-addon" style="cursor: pointer;" id="sstock"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tstock" placeholder="search" class="form-control">
                                                <input type="hidden" name="stock" id="stock" placeholder="search" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:13px;margin-left: 10px;">
                                    <div class="form-group">
                                        <label class="control-label  col-sm-5">Sales Transaction</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                              <span class="input-group-addon" style="cursor: pointer;" id="ssales_trans"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tsales_trans" placeholder="search" class="form-control">
                                                <input type="hidden" name="sales_transaction_id" id="sales_trans" placeholder="search" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-5">Sales Return</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="cursor: pointer;" id="ssales_return"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tsales_return" placeholder="search" class="form-control">
                                                <input type="hidden" name="sales_return_id" id="sales_return" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-5">Purchase Return</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                         <span class="input-group-addon" style="cursor: pointer;" id="spurchase_return"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tpurchase_return" placeholder="search" class="form-control">
                                                <input type="hidden" name="purchase_return_id" id="purchase_return" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-5">Cost of Good</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="    cursor: pointer;" id="salesorder"><i class="fa fa-search"></i></span>
                                                        <input type="hidden" id="purchaseOrderId"  name="sales_order_id" value="" class="form-control" placeholder="search">
                                                        <input type="text" id="sales_order_id"  name="" value="" class="form-control" placeholder="search">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="row">
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="tab-pane" id="tab_1" style="margin-top: 10px;">
                        <div class="tabbable-line boxless tabbable-reversed">
                            <ul class="nav nav-tabs">
                                <li class="active" style="background-color: #36c6d3;">
                                    <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Product Dimension</a>
                                </li>
                            </ul>
                            <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;height: 160px;">
                                <div class="tab-pane active" id="tab_0">
                                    <div class="portlet box">
                                        <div class="portlet-title">
                                        </div>
                                        <div class="portlet-body form">


                                            <div class="row" style="margin-top:10px;margin-left: 10px;">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-1" style="margin-right: 10px;">Width</label>
                                                            <div class="col-md-2">
                                                                <div class="input-group">
                                                                    <input type="text" name="width" value="" class="form-control" placeholder="-">
                                                                </div>
                                                            </div>
                                                            <label class="control-label  col-sm-1" style="margin-right: 10px;">Length</label>
                                                            <div class="col-md-2">
                                                                <div class="input-group">
                                                                    <input type="text" id=""  name="length" value="" class="form-control" placeholder="-">
                                                                </div>
                                                            </div>
                                                            <label class="control-label  col-sm-1" style="margin-right: 10px;">Height</label>
                                                            <div class="col-md-2">
                                                                <div class="input-group">
                                                                    <input type="text" id=""  name="height" value="" class="form-control" placeholder="-">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 13px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-1" style="margin-right: 10px; ">Weight</label>
                                                        <div class="col-md-2">
                                                            <div class="input-group">
                                                                <input type="text" name="weight" class="form-control" placeholder="-">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

                <div class="col-md-6">
        <div class="tab-pane" id="tab_1" style="margin-top: 10px;">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Purchase Information</a>
                    </li>
                </ul>
                <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;height: 160px;">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body form">


                                <div class="row" style="margin-top:10px;margin-left: 10px;">
                                            <div class="form-group">
                                                <label class="control-label  col-sm-5">Default Vendor</label>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                         <span class="input-group-addon" style="cursor: pointer;" id="svendor"><i class="fa fa-search"></i></span>
                                                <input type="text" id="tvendor" placeholder="search" class="form-control">
                                                <input type="hidden" name="vendor_id" id="vendor" placeholder="search" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <div class="row" style="margin-top:13px;margin-left: 10px;">
                                    <div class="form-group">
                                        <label class="control-label  col-sm-5">Tax Type</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="cursor: pointer;" id="stax"><i class="fa fa-search"></i></span>
                                                <input type="text" id="ttax" placeholder="search" class="form-control">
                                                <input type="hidden" name="tax_id" id="tax" placeholder="search" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
                    <div class="form-actions" style="margin-top: 10px; ">
                            <button type="button" class="btn green btnsaveproduct center-block">
                                <i class="fa fa-check"></i> Create</button>
                    </div>
    </form>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
            $(function () {
            var form = $('#formproduct');
            // $('#formproduct').validate();
            $(".btnsaveproduct").click(function () {
                var urls='{{url('api/product/addData')}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formproduct').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            //console.log(data)
                            //alert(data.msg);

                            //location.reload();
                            swal({
                                    title: "Product",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        location.href = '{{url('product')}}'
                                    }
                                })
                            )
                        }
                    });
                }
            });
            


            $("#tunit3").attr('disabled', 'disabled');
            $("#unit3qty").attr('disabled', 'disabled');
            $("#tunit4").attr('disabled', 'disabled');
            $("#unit4qty").attr('disabled', 'disabled');
            $("#tunit5").attr('disabled', 'disabled');
            $("#unit5qty").attr('disabled', 'disabled');
            
            $("form").keyup(function() {
// To Disable Submit Button
                $("#tunit3").attr('disabled', 'disabled');
                $("#unit3qty").attr('disabled', 'disabled');
                $("#tunit4").attr('disabled', 'disabled');
                $("#unit4qty").attr('disabled', 'disabled');
                $("#tunit5").attr('disabled', 'disabled');
                $("#unit5qty").attr('disabled', 'disabled');
// Validating Fields
                var unit_2_id = $("#tunit2").val();
                var unit_2_qty = $("#unit2qty").val();
                var unit_3_id = $("#tunit3").val();
                var unit_3_qty = $("#unit3qty").val();
                var unit_4_id = $("#tunit4").val();
                var unit_4_qty = $("#unit4qty").val();
                if (!(unit_2_id == "" || unit_2_qty == "")) {

                    $("#tunit3").removeAttr('disabled');
                    $("#unit3qty").removeAttr('disabled');
                }
                if(!(unit_3_id == "" || unit_3_qty == "")){
                    $("#tunit4").removeAttr('disabled');
                    $("#unit4qty").removeAttr('disabled');
                }
                if(!(unit_4_id == "" || unit_4_qty == "")){
                    $("#tunit5").removeAttr('disabled');
                    $("#unit5qty").removeAttr('disabled');
                }
            });
        });

       $( "#ttype" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/productType/getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#ttype" ).on( "autocompleteselect", function( event, ui ) {
                $('#type').val(ui.item.id).trigger('change');
            });
            $("#stype").click(function () {
                $('#ttype').val('').trigger('focus');
            });

        $( "#tbrand" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/brand/getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tbrand" ).on( "autocompleteselect", function( event, ui ) {
                $('#brand').val(ui.item.id).trigger('change');
            });
            $("#sbrand").click(function () {
                $('#tbrand').val('').trigger('focus');
            });

            $( "#tcategory" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/category/getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tcategory" ).on( "autocompleteselect", function( event, ui ) {
                $('#category').val(ui.item.id).trigger('change');
            });
            $("#scategory").click(function () {
                $('#tcategory').val('').trigger('focus');
            });

            $( "#tsubcategory" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('subCategory.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term,
                                id_cat:$("#category").val()
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tsubcategory" ).on( "autocompleteselect", function( event, ui ) {
                $('#subcategory').val(ui.item.id).trigger('change');
            });
            $("#ssubcategory").click(function () {
                $('#tsubcategory').val('').trigger('focus');
            });
             $( "#tprodgroup" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('productGroup.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tprodgroup" ).on( "autocompleteselect", function( event, ui ) {
                $('#prodgroup').val(ui.item.id).trigger('change');
            });
            $("#sprodgroup").click(function () {
                $('#tprodgroup').val('').trigger('focus');
            });

            $( "#tunit" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('unit.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tunit" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit').val(ui.item.id).trigger('change');
            });
            $("#sunit").click(function () {
                $('#tunit').val('').trigger('focus');
            });

            $( "#tunit2" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('unit.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tunit2" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit2').val(ui.item.id).trigger('change');
            });
            $("#sunit2").click(function () {
                $('#tunit2').val('').trigger('focus');
            });

           $( "#tunit3" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('unit.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tunit3" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit3').val(ui.item.id).trigger('change');
            });
            $("#sunit3").click(function () {
                $('#tunit3').val('').trigger('focus');
            });

            $( "#tunit4" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('unit.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tunit4" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit4').val(ui.item.id).trigger('change');
            });
            $("#sunit4").click(function () {
                $('#tunit4').val('').trigger('focus');
            });

            $( "#tunit5" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('unit.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tunit5" ).on( "autocompleteselect", function( event, ui ) {
                $('#unit5').val(ui.item.id).trigger('change');
            });
            $("#sunit5").click(function () {
                $('#tunit5').val('').trigger('focus');
            });

             $( "#tstock" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('stock.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tstock" ).on( "autocompleteselect", function( event, ui ) {
                $('#stock').val(ui.item.id).trigger('change');
            });
            $("#sstock").click(function () {
                $('#tstock').val('').trigger('focus');
            });
            $( "#tsales_trans" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('stock.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                         label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tsales_trans" ).on( "autocompleteselect", function( event, ui ) {
                $('#sales_trans').val(ui.item.id).trigger('change');
            });
            $("#ssales_trans").click(function () {
                $('#tsales_trans').val('').trigger('focus');
            });

            $( "#tsales_return" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('stock.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tsales_return" ).on( "autocompleteselect", function( event, ui ) {
                $('#sales_return').val(ui.item.id).trigger('change');
            });
            $("#ssales_return").click(function () {
                $('#tsales_return').val('').trigger('focus');
            });

            $( "#tpurchase_return" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{route('stock.getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.data, function (value, key) {
                                    return {
                                         label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tpurchase_return" ).on( "autocompleteselect", function( event, ui ) {
                $('#purchase_return').val(ui.item.id).trigger('change');
            });
            $("#spurchase_return").click(function () {
                $('#tpurchase_return').val('').trigger('focus');
            });

            $( "#tvendor" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/vendor/getAllData')}}",
                            dataType: "json",
                            data: {
                                code: request.term
                            },
                            success: function( data ) {
                                response($.map(data.msg, function (value, key) {
                                    console.log(value)
                                    return {
                                        label:value.code+"-"+value.name,
                                        value: value.code,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#tvendor" ).on( "autocompleteselect", function( event, ui ) {
                $('#vendor').val(ui.item.id).trigger('change');
            });
            $("#svendor").click(function () {
                $('#tvendor').val('').trigger('focus');
            });

$( "#ttax" ).autocomplete(
                {
                    source: function (request, response) {
                        $.ajax( {
                            url: "{{url('api/tax/getAllData')}}",
                            dataType: "json",
                            data: {
                                name: request.term
                            },
                            success: function( data ) {
                                response($.map(data.msg, function (value, key) {
                                    return {
                                        label:value.name,
                                        value: value.name,
                                        id:value.id
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 0,
                    open: function () {
                        $(this).data("uiAutocomplete").menu.element.addClass("");
                    }
                }
            ).focus(function(){
                $(this).data("uiAutocomplete").search($(this).val());
            });
            $( "#ttax" ).on( "autocompleteselect", function( event, ui ) {
                $('#tax').val(ui.item.id).trigger('change');
            });
            $("#stax").click(function () {
                $('#ttax').val('').trigger('focus');
            });

    </script>
    @endsection
