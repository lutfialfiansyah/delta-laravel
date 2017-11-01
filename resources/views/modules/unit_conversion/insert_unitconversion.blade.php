@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.unitconversion') !!}</a>
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
    <h1 class="page-title"> Insert Unit Conversion
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->

    <div class="tab-pane" id="tab_1">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Form Unit Conversion </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="{{route('unitconversion.addData')}}" id="formproductunit" method="post" class="horizontal-form">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <h3 class="form-section">Add Unit Conversion</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('product') ? ' has-error' : ''}}">
                                    <label for="single" class="control-label">Product Name</label>
                                    <select id="product" name="product" class="form-control select2">
                                        <option></option>
                                        @foreach($product as  $products)
                                            <option value="{{ $products->id }}">{{ $products->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('product'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('product')}}</strong></span>
                                        <span id="select2-customer-5o-container" class="select2-selection__rendered" title="Choose One">Choose One Product Unit</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_2_id') ? ' has-error' : ''}}">
                                    <label for="single" class="control-label">Unit 2</label>
                                    <select id="unit2" name="unit_2_id" class="form-control select2">
                                        <option></option>
                                        @foreach($unit as  $units)
                                            <option value="{{ $units->id }}">{{ $units->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('unit_2_id'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('unit_2_id')}}</strong></span>
                                        <span id="select2-customer-5o-container" class="select2-selection__rendered" title="Choose One">Choose One Unit 2</span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_2_qty') ? ' has-error' : ''}}">
                                    <label class="control-label">Unit 2 QTY</label>
                                    <input type="text" id="unit2qty" name="unit_2_qty" class="form-control" placeholder="Quantity">
                                    @if($errors->has('unit_2_qty'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_2_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_3_id') ? ' has-error' : ''}}">
                                    <label for="single" class="control-label">Unit 3</label>
                                    <select id="unit3" name="unit_3_id" class="form-control select2">
                                        <option>Choose Unit</option>

                                    </select>
                                    @if($errors->has('unit_3_id'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('unit_3_id')}}</strong></span>
                                        <span id="select2-customer-5o-container" class="select2-selection__rendered" title="Choose One">Choose One Unit 3</span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_3_qty') ? ' has-error' : ''}}">
                                    <label>Unit 3 QTY</label>
                                    <input type="text" id="unit3qty" name="unit_3_qty" class="form-control" placeholder="Quantity">
                                    @if($errors->has('unit_3_qty'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_3_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_4_id') ? ' has-error' : ''}}">
                                    <label for="single" class="control-label">Unit 4</label>
                                    <select id="unit4" name="unit_4_id" class="form-control select2">
                                        <option></option>
                                        @foreach($unit as  $units)
                                            <option value="{{ $units->id }}">{{ $units->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('unit_4_id'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('unit_4_id')}}</strong></span>
                                        <span id="select2-customer-5o-container" class="select2-selection__rendered" title="Choose One">Choose One Unit 4</span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_4_qty') ? ' has-error' : ''}} ">
                                    <label class="control-label">Unit 4 QTY</label>
                                    <input type="text" id="unit4qty" name="unit_4_qty" class="form-control" placeholder="Quantity">
                                    @if($errors->has('unit_4_qty'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_4_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_5_id') ? ' has-error' : ''}}">
                                    <label for="single" class="control-label">Unit 5</label>
                                    <select id="unit5" name="unit_5_id" class="form-control select2">
                                        <option></option>
                                        @foreach($unit as  $units)
                                            <option value="{{ $units->id }}">{{ $units->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('unit_5_id'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('unit_5_id')}}</strong></span>
                                        <span id="select2-customer-5o-container" class="select2-selection__rendered" title="Choose One">Choose One Unit 5</span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('unit_5_qty') ? ' has-error' : ''}}">
                                    <label class="control-label">Unit 5 QTY</label>
                                    <input type="text" id="unit5qty" name="unit_5_qty" class="form-control" placeholder="Quantity">
                                    @if($errors->has('unit_5_qty'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_5_qty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->

                    </div>
                    <div class="form-actions right">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="submit" class="btn blue btnsaveproductunit">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        @if( Session::has('flash_message') and Session::has('message'))
        swal({
            title: "{{ Session::get('message') }}",
            text: "{{ Session::get('flash_message') }}",
            type: "{{ Session::get('type') }}",
            confirmButtonClass: "{{ Session::get('confirm_button') }}",
            timer: "{{ Session::get('timer') }}"
        })
        @endif
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
                        //unit_3_id.val().prop('selected', true);
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
            /*$(".btnsaveproductunit").click(function () {
                var urls='{{route('unitconversion.addData')}}';
                if(form.valid()) {
                    $.ajax({
                        url: urls,
                        type: 'POST',
                        data: $('#formproductunit').serialize(),
                        datatype: 'json',
                        success: function (data) {
                            //console.log(data)
                            //alert(data.msg);
                            //exit;
                            //location.reload();
                            swal({
                                    title: "Unit Conversion",
                                    text: data.msg,
                                    type: data.type,
                                    confirmButtonClass: 'btn btn-success'
                                }, (function () {
                                    if (data.status = true) {
                                        //location.href = '{{url('unitconversion')}}'
                                    }
                                })
                            )
                        }
                    });
                }
            })*/
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
            var form = $('#formproductunit');
            $('#formproductunit').validate({
                    rules: {
                        product:{
                          required:true,

                        },
                        unit_2_id: {
                            required: true,
                            {{--remote:--}}
                                {{--{--}}
                                    {{--url: '{{url('unitconversion/cekdata')}}',--}}
                                    {{--type: "post",--}}
                                    {{--data: {--}}
                                        {{--unit_2_id: function () {--}}
                                            {{--return $("#unit_2_id").val();--}}
                                        {{--}--}}
                                    {{--}--}}
                                {{--}--}}
                        },
                        unit_3_id: {
                            required: false,
                            {{--remote:--}}
                                {{--{--}}
                                    {{--url: '{{url('unitconversion/cekdata')}}',--}}
                                    {{--type: "post",--}}
                                    {{--data: {--}}
                                        {{--unit_3_id: function () {--}}
                                            {{--return $("#unit_3_id").val();--}}
                                        {{--}--}}
                                    {{--}--}}
                                {{--}--}}
                        },
                        unit_4_id: {
                            required: false,
                            {{--remote:--}}
                                {{--{--}}
                                    {{--url: '{{url('unitconversion/cekdata')}}',--}}
                                    {{--type: "post",--}}
                                    {{--data: {--}}
                                        {{--unit_4_id: function () {--}}
                                            {{--return $("#unit_4_id").val();--}}
                                        {{--}--}}
                                    {{--}--}}
                                {{--}--}}
                        },
                        unit_5_id: {
                            required: false,
                            {{--remote:--}}
                                {{--{--}}
                                    {{--url: '{{url('unitconversion/cekdata')}}',--}}
                                    {{--type: "post",--}}
                                    {{--data: {--}}
                                        {{--unit_5_id: function () {--}}
                                            {{--return $("#unit_5_id").val();--}}
                                        {{--}--}}
                                    {{--}--}}
                                {{--}--}}
                        },
                        message: {
                            remote: "This Patch already exists."
                        }
                    }

                }
            );
        });
    </script>
@endsection
