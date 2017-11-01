@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('edit.unitconversion') !!}</a>
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
    <h1 class="page-title"> Edit Product Unit
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Product Unit </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="{{ route('unitconversion.updateData',$productunit->id) }}" id="formproductunit" method="post" class="horizontal-form">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <h3 class="form-section">Edit Product Unit</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="single" class="control-label">Product</label>
                                    <select id="product" name="product" class="form-control select2">
                                        <option></option>
                                        @foreach($product as  $products)
                                            <option @if( $products->id ) selected @endif value="{{$products->id}}" >{{ $products->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Unit 2</label>
                                    <select id="unit2" name="unit_2_id" class="form-control select2">
                                        <option></option>
                                        @foreach($units as $unit)
                                            <option @if($productunit->unit_2_id==$unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Unit 2 QTY</label>
                                    <input type="text" value="{{$productunit->unit_2_qty}}" id="unit2qty" name="unit_2_qty" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Unit 3</label>
                                    <select id="unit3" name="unit_3_id" class="form-control select2">
                                        <option></option>
                                        @foreach($units as $unit)
                                            <option @if($productunit->unit_3_id==$unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit 3 QTY</label>
                                    <input type="text" id="unit3qty" value="{{$productunit->unit_3_qty}}" name="unit_3_qty" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Unit 4</label>
                                    <select id="unit4" name="unit_4_id" class="form-control select2">
                                        <option></option>
                                        @foreach($units as $unit)
                                            <option @if($productunit->unit_4_id==$unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Unit 4 QTY</label>
                                    <input type="text" value="{{$productunit->unit_4_qty}}" id="unit4qty" name="unit_4_qty" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="single" class="control-label">Unit 5</label>
                                    <select id="unit5" name="unit_5_id" class="form-control select2">
                                        <option></option>
                                        @foreach($units as $unit)
                                            <option @if($productunit->unit_5_id==$unit->id) selected @endif value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Unit 5 QTY</label>
                                    <input type="text" value="{{$productunit->unit_5_qty}}" id="unit5qty" name="unit_5_qty" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="submit" class="btn blue btnupdateproductunit">
                            <i class="fa fa-check"></i> Update</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#unit2').change( function() {
                $.post('{{ url('api/unitconversion/cekUnitData') }}',
                    {
                        u1: $('#unit2').val(),u2:0, u3: 0
                    }, function (data) {
                        console.log(data);
                        var unit_3_id = $('#unit3');
                        $('#unit3').empty();
                        $('#unit3').append('<option value="">Choose Unit</option>')
                        $.each(data.msg, function (value, display) {
                            $('#unit3').append('<option value="' + display['id'] + '">' + display['name'] + '</option>')
                        });
                        unit_3_id.val().prop('selected', true);
                    });
            });
            $('#unit3').change( function() {
                $.post('{{ url('api/unitconversion/cekUnitData') }}',
                    {
                        u1: $('#unit2').val(),u2:$('#unit3').val(), u3: 0
                    }, function (data) {
                        console.log(data);
                        var unit_4_id = $('#unit4');
                        $('#unit4').empty();
                        $('#unit4').append('<option value="">Choose Unit</option>')
                        $.each(data.msg, function (value, display) {
                            $('#unit4').append('<option value="' + display['id'] + '">' + display['name'] + '</option>')
                        });
                        unit_4_id.val().prop('selected', true);
                    });
            });
            $('#unit4').change( function() {
                $.post('{{ url('api/unitconversion/cekUnitData') }}',
                    {
                        u1: $('#unit2').val(),u2:$('#unit3').val(), u3: $('#unit4').val()
                    }, function (data) {
                        console.log(data);
                        var unit_5_id = $('#unit5');
                        $('#unit5').empty();
                        $('#unit5').append('<option value="">Choose Unit</option>')
                        $.each(data.msg, function (value, display) {
                            $('#unit5').append('<option value="' + display['id'] + '">' + display['name'] + '</option>')
                        });
                        unit_5_id.val().prop('selected', true);
                    });
            });
            $("#product").select2({
                placeholder: "Choose Product",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth : true,
                width: 'auto'
            });
            $("#unit2").select2({
                placeholder: "Choose Unit",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth : true,
                width: 'auto'
            });
            $("#unit3").select2({
                placeholder: "Choose Unit",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth : true,
                width: 'auto'
            });
            $("#unit4").select2({
                placeholder: "Choose Unit",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth : true,
                width: 'auto'
            });
            $("#unit5").select2({
                placeholder: "Choose Unit",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth : true,
                width: 'auto'
            });
        });
        $(document).ready(function() {
            $("#unit3").attr('disabled', 'disabled');
            $("#unit3qty").attr('disabled', 'disabled');
            $("#unit4").attr('disabled', 'disabled');
            $("#unit4qty").attr('disabled', 'disabled');
            $("#unit5").attr('disabled', 'disabled');
            $("#unit5qty").attr('disabled', 'disabled');
            $("form").keyup(function() {
// To Disable Submit Button
                $("#unit3").attr('disabled', 'disabled');
                $("#unit3qty").attr('disabled', 'disabled');
                $("#unit4").attr('disabled', 'disabled');
                $("#unit4qty").attr('disabled', 'disabled');
                $("#unit5").attr('disabled', 'disabled');
                $("#unit5qty").attr('disabled', 'disabled');
// Validating Fields
                var unit_2_id = $("#unit2").val();
                var unit_2_qty = $("#unit2qty").val();
                var unit_3_id = $("#unit3").val();
                var unit_3_qty = $("#unit3qty").val();
                var unit_4_id = $("#unit4").val();
                var unit_4_qty = $("#unit4qty").val();
                if (!(unit_2_id == "" || unit_2_qty == "")) {

                    $("#unit3").removeAttr('disabled');
                    $("#unit3qty").removeAttr('disabled');
                }
                if(!(unit_3_id == "" || unit_3_qty == "")){
                    $("#unit4").removeAttr('disabled');
                    $("#unit4qty").removeAttr('disabled');
                }
                if(!(unit_4_id == "" || unit_4_qty == "")){
                    $("#unit5").removeAttr('disabled');
                    $("#unit5qty").removeAttr('disabled');
                }
            });
        });
    </script>
@endsection
