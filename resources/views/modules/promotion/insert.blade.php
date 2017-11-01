@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <style>
      .tab-content{
        height: 200px;
        overflow-y: scroll;
      }
      .portlet-body{
        padding: 0px !important;
        margin-top: -31px !important;
      }
    </style>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('view.purchase') !!}</a>
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
      <div class="tab-pane" id="tab_1">
          <div class="portlet box">
              <div class="portlet-body">
                  <div class="form-body">
                      <div class="row">
                          <div class="col-md-8">
                              <span style="font-size: 24px;">Create Promotion</span>
                          </div>
                        </div>
                        <div class="tabbable-line boxless tabbable-reversed">
                            <ul class="nav nav-tabs">
                                <li class="active" style="background-color: #36c6d3;">
                                    <a href="#tab_0" data-toggle="tab" aria-expanded="true">Promotion Detail</a>
                                </li>
                            </ul>
                            <div class="tab-content" style="    border: #ccc solid 1px;     overflow-x: hidden;    height: 133px;
">
                                <div class="tab-pane active" id="tab_0">
                                    <div class="portlet box">
                                        <div class="portlet-body">
                                            <div class="row" style="margin-top:15px">
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-2">Code</label>
                                                          <div class="col-sm-10">
                                                            <input type="text" name="code" value="{{$code}}" class="form-control">
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">Description</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" name="description" class="form-control">
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">Time Start</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" name="time_start" class="form-control date">
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">End Start</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" name="time_end" class="form-control date">
                                                          </div>
                                                      </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top:15px">
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-2">Qty</label>
                                                          <div class="col-sm-10">
                                                            <input type="text" name="qty" class="form-control">
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">Unit</label>
                                                          <div class="col-sm-8">
                                                            <div class="input-group">
                                                            <input name="unit_id" type="hidden"  style="width: 100%"  id="unit_id" class="form-control">
                                                            <span class="input-group-addon"  id="sunit" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                                            <input name=""  style="width: 100%"  id="unit" class="form-control">
                                                          </div>
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">Disc</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" name="disc" class="form-control">
                                                          </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-3">
                                                      <div class="form-group">
                                                          <label class="label-control col-sm-4">Disc 2</label>
                                                          <div class="col-sm-8">
                                                            <input type="text" name="disc2" class="form-control">
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
                                  <div class="tabbable-line boxless tabbable-reversed">
                                    <ul class="nav nav-tabs">
                                        <li class="active" style="background-color: #36c6d3;">
                                            <a href="#tab_0" data-toggle="tab" aria-expanded="true">Product</a>
                                        </li>
                                        <li style="float:right !important;border:none !important">

                                          <div class="input-group" style="    width: 78%;
    float: right;
    margin-top: -39px;">
                                          <input name="" type="hidden"  style="width: 100%"  id="product_id" class="form-control">
                                          <span class="input-group-addon"  id="sproduct" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                          <input name=""  style="width: 100%"  id="productids" class="form-control">
                                          </div>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="    border: #ccc solid 1px; ">
                                        <div class="tab-pane active" id="tab_0">
                                            <div class="portlet box">
                                                <div class="portlet-body">
                                                    <table class="table table-hover table-bordered" id="table-product">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="tabbable-line boxless tabbable-reversed">
                                    <ul class="nav nav-tabs">
                                        <li class="active" style="background-color: #36c6d3;">
                                            <a href="#tab_0" data-toggle="tab" aria-expanded="true">brand</a>
                                        </li>
                                        <li style="float:right !important;border:none !important">
                                          <div class="input-group" style="    width: 78%;
    float: right;
    margin-top: -39px;">
                                          <input name="" type="hidden"  style="width: 100%"  id="brand_id" class="form-control">
                                          <span class="input-group-addon"  id="sbrand" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                          <input name=""  style="width: 100%;z-index: 0;"  id="brand" class="form-control">
                                          </div>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="    border: #ccc solid 1px; ">
                                        <div class="tab-pane active" id="tab_0">
                                            <div class="portlet box">
                                                <div class="portlet-body">
                                                  <table class="table table-hover table-bordered" id="table-brand">
                                                      <thead>
                                                          <tr>
                                                              <th>Name</th>
                                                              <th>Action</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="tabbable-line boxless tabbable-reversed">
                              <ul class="nav nav-tabs">
                                  <li class="active" style="background-color: #36c6d3;">
                                      <a href="#tab_0" data-toggle="tab" aria-expanded="true">Category</a>
                                  </li>
                                  <li style="float:right !important;border:none !important">
                                    <div class="input-group" style="    width: 78%;
                                    float: right;
                                    margin-top: -39px;">
                                    <input name="" type="hidden"  style="width: 100%"  id="category_id" class="form-control">
                                    <span class="input-group-addon"  id="scategory" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="tcategory" class="form-control">
                                    </div>
                                  </li>
                              </ul>
                              <div class="tab-content" style="    border: #ccc solid 1px; ">
                                  <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-body">
                                            <table class="table table-hover table-bordered" id="table-category">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tabbable-line boxless tabbable-reversed">
                              <ul class="nav nav-tabs">
                                  <li class="active" style="background-color: #36c6d3;">
                                      <a href="#tab_0" data-toggle="tab" aria-expanded="true">Sub Category</a>
                                  </li>
                                  <li style="float:right !important;border:none !important">
                                    <div class="input-group" style="    width: 70%;
float: right;
margin-top: -39px;">
                                    <input name="" type="hidden"  style="width: 100%"  id="subcategory_id" class="form-control">
                                    <span class="input-group-addon"  id="ssubcategory" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="tsubcategory" class="form-control">
                                    </div>
                                  </li>
                              </ul>
                              <div class="tab-content" style="    border: #ccc solid 1px; ">
                                  <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-body">
                                            <table class="table table-hover table-bordered" id="table-subcat">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="tabbable-line boxless tabbable-reversed">
                              <ul class="nav nav-tabs">
                                  <li class="active" style="background-color: #36c6d3;">
                                      <a href="#tab_0" data-toggle="tab" aria-expanded="true">Product Type</a>
                                  </li>
                                  <li style="float:right !important;border:none !important">
                                    <div class="input-group" style="    width: 74%;
                                    float: right;
                                    margin-top: -39px;">
                                    <input name="" type="hidden"  style="width: 100%"  id="type" class="form-control">
                                    <span class="input-group-addon"  id="stype" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="ttype" class="form-control">
                                    </div>
                                  </li>
                              </ul>
                              <div class="tab-content" style="    border: #ccc solid 1px; ">
                                  <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-body">
                                            <table class="table table-hover table-bordered" id="table-type">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tabbable-line boxless tabbable-reversed">
                              <ul class="nav nav-tabs">
                                  <li class="active" style="background-color: #36c6d3;">
                                      <a href="#tab_0" data-toggle="tab" aria-expanded="true">Product Group</a>
                                  </li>
                                  <li style="float:right !important;border:none !important">
                                    <div class="input-group" style="    width: 70%;
                      float: right;
                      margin-top: -39px;">
                                    <input name="" type="hidden"  style="width: 100%"  id="prodgroup_id" class="form-control">
                                    <span class="input-group-addon"  id="sprodgroup" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="tprodgroup" class="form-control">
                                    </div>
                                  </li>
                              </ul>
                              <div class="tab-content" style="    border: #ccc solid 1px; ">
                                  <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-body">
                                            <table class="table table-hover table-bordered" id="table-group">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="tabbable-line boxless tabbable-reversed">
                              <ul class="nav nav-tabs">
                                  <li class="active" style="background-color: #36c6d3;">
                                      <a href="#tab_0" data-toggle="tab" aria-expanded="true">Customer group</a>
                                  </li>
                                  <li style="float:right !important;border:none !important">

                                    <div class="input-group" style="    width: 70%;
float: right;
margin-top: -39px;">
                                    <input name="" type="hidden"  style="width: 100%"  id="customer_group_id" class="form-control">
                                    <span class="input-group-addon"  id="scustomer_group" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                    <input name=""  style="width: 100%"  id="customer_group" class="form-control">
                                    </div>
                                  </li>
                              </ul>
                              <div class="tab-content" style="    border: #ccc solid 1px; ">
                                  <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-body">
                                              <table class="table table-hover table-bordered" id="table-customer_group">
                                                  <thead>
                                                      <tr>
                                                          <th>Name</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                  </tbody>
                                              </table>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>

                </div>
                      <div class="form-actions center" style="margin-top:10px">
                          <center>
                          <button type="button" class="btn green btnSaveProduct">
                              <i class="fa fa-check"></i> Create</button>
                          </center>
                      </div>
                    </div>
                    <div>
                  </div>
              </div>
            </div>
          </div>
    </form>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(function(){
    $( "#customer_group" ).autocomplete(
        {
            source: function (request, response) {
                $.ajax( {
                    url: "{{route('customer_group.getAllData')}}",
                    dataType: "json",
                    data: {
                        name: request.term
                    },
                    success: function( data ) {
                        response($.map(data.msg, function (value, key) {
                            return {
                                label:value.name,
                                value: value.name,
                                  name:value.name,
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
    $( "#customer_group" ).on( "autocompleteselect", function( event, ui ) {
      var count = $('#table-customer_group tbody tr').length;
      var table = document.getElementById("table-customer_group").getElementsByTagName('tbody')[0];
      var row = table.insertRow(count);
      var name = row.insertCell(0)
      var action = row.insertCell(1)
      name.innerHTML="<input type='hidden' name='customer_group_id[]' value='"+ui.item.id+"'>"+ui.item.name;
      action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deleteProduct'><i class='icon-trash'></i></button>"
      $('#productids').val('1').trigger('change')
    });
    $("#scustomer_group").click(function () {
        $('#customer_group').val('').trigger('focus');
    });
    $( "#unit" ).autocomplete(
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
    $( "#unit" ).on( "autocompleteselect", function( event, ui ) {
        $('#unit_id').val(ui.item.id).trigger('change');
    });
    $("#sunit").click(function () {
        $('#unit').val('').trigger('focus');
    });
    var form = $('#formPurchaser');
    $('#formPurchaser').validate();
    $(".btnSaveProduct").click(function(){
        var urls='{{route('promotion.addData')}}';
        if(form.valid()) {
            $.ajax({
                url: urls,
                type: 'POST',
                data: $('#formPurchaser').serialize(),
                datatype: 'json',
                success: function (data) {
                    //console.log(data)
                    //alert(data.msg);
                    //location.reload();
                    //exit;
                    swal({
                            title: "Promotion",
                            text: data.msg,
                            type: data.type,
                            confirmButtonClass: 'btn btn-success'
                        }, (function () {
                            if (data.status = true) {
                                location.href = '{{url('promotion')}}'
                            }
                        })
                    )
                }
            });}
    })
    $('.date').datetimepicker({format: 'yyyy-mm-dd hh:ii'});

  $("#sproduct").click(function(){
      $("#productids").val('').trigger('focus')
  })
  $("#productids").autocomplete({
      source:function(request,response){
          $.ajax( {
              url: "{{url('api/product/getAllsData')}}",
              dataType: "json",
              data: {
                  code: request.term
              },
              success: function( data ) {
                  response($.map(data.data, function (value, key) {
                      //console.log(value)
                      return {
                          label: value.code+" - "+value.item_no+" / "+value.name,
                          value: value.code,
                          name:value.name,
                          id:value.id,
                      };
                  }));
              },
          });
      },minLength:0
  }).focus(function(){
      $(this).data("uiAutocomplete").search($(this).val());
  });
  $( "#productids" ).on( "autocompleteselect", function( event, ui ) {
      var count = $('#table-product tbody tr').length;
      var table = document.getElementById("table-product").getElementsByTagName('tbody')[0];
      var row = table.insertRow(count);
      var name = row.insertCell(0)
      var action = row.insertCell(1)
      name.innerHTML="<input type='hidden' name='product_id[]' value='"+ui.item.id+"'>"+ui.item.name;
      action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deleteProduct'><i class='icon-trash'></i></button>"
      $('#productids').val('1').trigger('change')
    });
    $(document).on("click", '.deleteProduct',function(){
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
                document.getElementById("table-product").getElementsByTagName('tbody')[0].deleteRow(rowindex);
            }
        })
    })
    $( "#brand" ).autocomplete(
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
                                    name:value.name,
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
        $( "#brand" ).on( "autocompleteselect", function( event, ui ) {
            var count = $('#table-brand tbody tr').length;
            var table = document.getElementById("table-brand").getElementsByTagName('tbody')[0];
            var row = table.insertRow(count);
            var name = row.insertCell(0)
            var action = row.insertCell(1)
            name.innerHTML="<input type='hidden' name='brand_id[]' value='"+ui.item.id+"'>"+ui.item.name;
            action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deletebrand'><i class='icon-trash'></i></button>"
            $('#brand').val('1').trigger('change')
        });
        $(document).on("click", '.deletebrand',function(){
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
                    document.getElementById("table-brand").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                }
            })
        })
        $("#sbrand").click(function () {
            $('#brand').val('').trigger('focus');
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
                                      name:value.name,
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
            var count = $('#table-category tbody tr').length;
            var table = document.getElementById("table-category").getElementsByTagName('tbody')[0];
            var row = table.insertRow(count);
            var name = row.insertCell(0)
            var action = row.insertCell(1)
            name.innerHTML="<input type='hidden' name='category_id[]' value='"+ui.item.id+"'>"+ui.item.name;
            action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deletecat'><i class='icon-trash'></i></button>"
            $('#brand').val('1').trigger('change')
        });
        $(document).on("click", '.deletecat',function(){
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
                    document.getElementById("table-category").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                }
            })
        })
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
                              id_cat:''
                          },
                          success: function( data ) {
                              response($.map(data.data, function (value, key) {
                                  return {
                                      label:value.code+"-"+value.name,
                                      value: value.code,
                                      id:value.id,
                                        name:value.name
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
            var count = $('#table-subcat tbody tr').length;
            var table = document.getElementById("table-subcat").getElementsByTagName('tbody')[0];
            var row = table.insertRow(count);
            var name = row.insertCell(0)
            var action = row.insertCell(1)
            name.innerHTML="<input type='hidden' name='subcategory_id[]' value='"+ui.item.id+"'>"+ui.item.name;
            action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deletesubcat'><i class='icon-trash'></i></button>"
            $('#brand').val('1').trigger('change')
        });
        $(document).on("click", '.deletesubcat',function(){
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
                    document.getElementById("table-subcat").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                }
            })
        })
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
                                       name:value.name,
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
           var count = $('#table-group tbody tr').length;
           var table = document.getElementById("table-group").getElementsByTagName('tbody')[0];
           var row = table.insertRow(count);
           var name = row.insertCell(0)
           var action = row.insertCell(1)
           name.innerHTML="<input type='hidden' name='group_id[]' value='"+ui.item.id+"'>"+ui.item.name;
           action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deletegroup'><i class='icon-trash'></i></button>"
           $('#brand').val('1').trigger('change')
       });
       $(document).on("click", '.deletegroup',function(){
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
                   document.getElementById("table-group").getElementsByTagName('tbody')[0].deleteRow(rowindex);
               }
           })
       })
         $("#sprodgroup").click(function () {
             $('#tprodgroup').val('').trigger('focus');
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
                                            name:value.name,
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
                var count = $('#table-type tbody tr').length;
                var table = document.getElementById("table-type").getElementsByTagName('tbody')[0];
                var row = table.insertRow(count);
                var name = row.insertCell(0)
                var action = row.insertCell(1)
                name.innerHTML="<input type='hidden' name='type_id[]' value='"+ui.item.id+"'>"+ui.item.name;
                action.innerHTML="<button type='button' style='float:right' data-index='"+count+"' class='btn btn-danger deletetype'><i class='icon-trash'></i></button>"
                $('#brand').val('1').trigger('change')
            });
            $(document).on("click", '.deletegroup',function(){
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
                        document.getElementById("table-type").getElementsByTagName('tbody')[0].deleteRow(rowindex);
                    }
                })
            })
              $("#stype").click(function () {
                  $('#ttype').val('').trigger('focus');
              });
            });
  </script>
@endsection
