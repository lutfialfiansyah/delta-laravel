@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.product') !!}</a>
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
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Insert Product
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Product </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="#" id="formproduct" method="post" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Edit Product</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Code</label>
                                    <input type="text" required id="code" name="code"  value="{{$product->code}}" class="form-control" placeholder="B001">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Item No</label>
                                    <input type="text" required id="itemno" name="itemno" value="{{$product->item_no}}" class="form-control" placeholder="SKUxxxxx">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Branch</label>
                                    <select  required class="form-control select2" name="branch">
                                        <option value="">Choose a Branch</option>
                                        @foreach($branch as $row)
                                            <option @if($product->branch_id==$row->id) selected @endif value="{{$row->id}}">{{$row->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input required type="text" value="{{$product->name}}" id="name" name="name" class="form-control" placeholder="-">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Unit</label>
                                    <select  required class="form-control select2" name="unit">
                                        <option value="">Choose a Unit</option>
                                        @foreach($units as $unit)
                                            <option @if($product->unit_id==$unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select required class="form-control select2" name="type">
                                        <option value="">Choose a Type</option>
                                        @foreach($types as $type)
                                            <option @if($product->type_id==$type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select  required class="form-control category select2" name="category" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="">Choose a Category</option>
                                        @foreach($categorys as $category)
                                            <option @if($product->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Sub Category</label>
                                    <select required class="form-control subcategory select2" name="subcategory" data-placeholder="Choose a Sub Category" tabindex="1">
                                        <option value="1">Choose a Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Brand</label>
                                    <select required class="form-control select2" name="brand" data-placeholder="Choose a brand" tabindex="1">
                                        <option value="">Choose a Brand</option>
                                        @foreach($brands as $brand)
                                            <option @if($product->brand_id==$brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Group</label>
                                    <select  required class="form-control select2" name="group" data-placeholder="Choose a group" tabindex="1">
                                        <option value="">Choose a Group</option>
                                        @foreach($groups as $group)
                                            <option @if($product->group_id==$group->id) selected @endif  value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Max Payment periode</label>
                                    <input required type="text" value="{{$product->max_payment_periode}}" name="maxpaymentperiode" class="form-control"> </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>stok Minimum</label>
                                    <input required type="number" value="{{$product->stock_minimum}}" name="stokmin" class="form-control"> </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="button" class="btn blue btnsaveproduct">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".select2").select2();
            $('.date-picker').datepicker({
                autoclose: true
            });
            var form = $('#formproduct');
            $('#formproduct').validate();
            $(".btnsaveproduct").click(function () {
                var urls='{{route('product.updateData',['id'=>$product->id])}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formproduct').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            console.log(data)
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
            })
            $(".category").change(function () {
                $('.subcategory').html("");
                $.get('{{url('productcategory/getSubCategory')}}/'+$(this).val(),function(data){
                    $.each(data.msg,function(index, value){
                        $('.subcategory')
                            .append("<option value='"+value['id']+"'>"+value['name']+"</option>");
                    });
                })
            })
        });
    </script>
@endsection