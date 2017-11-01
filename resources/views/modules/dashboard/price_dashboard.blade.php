@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('price') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
        @endif
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Price Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a data-toggle="modal" href="#mdlPrice" class="btn sbold green btn-circle btn-sm btnbrandadd" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-excel-o"></i> Import Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-price">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Branch</th>
                            <th>Product Name</th>
                            <th>Customer Group</th>
                            <th>Price</th>
                            <th>Disc1</th>
                            <th>Disc2</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="modal fade draggable-modal" id="mdlPrice" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Price</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="formprice">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Branch </label>
                                    <select name="branch_id"  id="branchid" class="form-control">
                                        <option value="">Choose a Branch</option>
                                        @foreach($branch as $branchs)
                                            <option value="{{$branchs->id}}">{{$branchs->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Customer Group</label>
                                    <select class="form-control" id="groupid" required name="customer_group">
                                        <option value="">Choose a Customer Group</option>
                                        @foreach($customers as $customerGroup)
                                            <option value="{{$customerGroup->id}}">{{$customerGroup->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Product </label>
<div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                        <input name="product_id" type="hidden"  style="width: 100%"  id="product_id" class="form-control">
                                        <span class="input-group-addon"  id="sproduct" style="    cursor: pointer;" ><i class="fa fa-search"></i></span>
                                        <input name=""  style="width: 100%"  id="productids" class="form-control">
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" id="price" name="price" data-id="0" class="form-control"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>disc 1</label>
                                    <input type="number" id="price" name="disc1" data-id="0" class="form-control"> </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Disc 2</label>
                                    <input type="number" id="price" name="disc2" data-id="0" class="form-control"> </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnall">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function(){
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
                              console.log(value)
                              return {
                                  label: value.code+"-"+value.item_no,
                                  value: value.code,
                                  id:value.id,
                                  item:value.item_no,
                                  name:value.name,
                                  price:value.selling_price,
                                  unit:value.unit_name,
                                  unit_id:value.unit_id,
                                  disc1:value.reg_disc_1,
                                  disc2:value.reg_disc_2
                              };
                          }));
                      },
                  });
              },minLength:0
          }).focus(function(){
              $(this).data("uiAutocomplete").search($(this).val());
          });
          $( "#productids" ).on( "autocompleteselect", function( event, ui ) {
              $('#product_id').val(ui.item.id).trigger('change')
          })
            var oTable = $('#table-price').DataTable({
                sDom: '<Rlfr<"branch"><t>p>',

                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('price.getData') }}",
                "fnDrawCallback": function () {
                    $("#table-price a.priceedit").click(function () {
                        $("#price").val($(this).attr('data-price'));
                        $("#price").attr('data-id',$(this).attr('data-id'));
                        $(".btnall").addClass('btnedit');
                        $(".btnall").removeClass('btnadd');
                        SelectElement('productid',$(this).attr('data-productid'));
                        SelectElement('groupid',$(this).attr('data-groupid'));
                        SelectElement('branchid',$(this).attr('data-branchid'));
                        $("#mdlPrice").modal();
                    }),
                        $("a.delete").click(function () {
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
                                            url: '{{url('api/price/deleteData/')}}/'+id,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                /*console.log(data.msg)
                                                alert(data.msg);
                                                location.reload();*/
                                                swal({
                                                        title: data.title,
                                                        text: data.msg,
                                                        type: data.type,
                                                        confirmButtonClass: 'btn btn-success'
                                                    },(function(){
                                                        location.reload()
                                                    })
                                                )
                                            }
                                        });
                                    }
                                }
                            )
                        })
                },
                "columns": [
                    {data: "id",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'branch_id', name: 'branch_id'},
                    {data: 'name', name: 'name'},
                    {data: 'customer_group', name: 'customer_group'},
                    {data: 'selling_price', name: 'price'},
                    {data: 'reg_disc_1', name: 'reg_disc_1'},
                    {data: 'reg_disc_2', name: 'reg_disc_2'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'updated_by', name: 'updated_by'},
                    {data: 'action', name: 'action'}
                ]
            });
            var branch="";
            $.get('{{url('api/branch/getBranch')}}',function(data){
                console.log(data);
                $.each(data.msg,function(index,value){
                    branch += "<option value='"+value['id']+"'>"+value['description']+"</option>"
                });
                $("div.branch").html('<label><select name="branch"><option value="">All</option>'+branch+'</select></label>');
            });
            $(".btnall").click(function() {
                var dataid =  $("#price").attr('data-id');
                var urls="";
                if(dataid==0){
                    urls='{{route('price.addData')}}';
                }else{
                    urls='{{url('api/price/updateData')}}/'+dataid;
                }
                $.ajax({
                    url: urls,
                    type: 'POST',
                    data: $('#formprice').serialize(),
                    datatype: 'json',
                    success: function (data) {
                        //console.log(data)
                        //alert(data.msg);
                        //location.reload();*/
                        $("#mdlPrice").modal('hide');
                        swal({
                                title: data.title,
                                text: data.msg,
                                type: data.type,
                                confirmButtonClass: 'btn btn-success'
                            },(function(){
                                if(data.status==true){
                                    location.reload();
                                }
                            })
                        )
                    }
                });
            });
        })

    </script>
@endsection
