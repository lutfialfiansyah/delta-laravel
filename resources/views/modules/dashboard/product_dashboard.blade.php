@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('product') !!}</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase"> Product Table</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided">
                            <a href="{{ url('/product/insert_productv2') }}" class="btn sbold green btn-circle btn-sm" >Add New <i class="fa fa-plus"></i></a>
                            <button class="btn btn-transparent dark btn-outline btn-circle btn-sm" data-toggle="dropdown">Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="{{ route('export.product','xlsx') }}">
                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="#mdlExcel" data-toggle="modal">
                                        <i class="fa fa-file-excel-o"></i> Import Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <button id='triggerShow'>Filter</button>
                    <div id='filterId' class="row">
                        <div class="col-md-12 ">
                            <input type="text" class="form-control global_filter" placeholder="Global Search" id="global_filter"><br>
                        </div>
                        <div class="col-md-4">
                            <select class="column_filter" id="col4_filter" data-column="4"><option value=""></option></select><br>
                            <select class="column_filter" id="col5_filter" data-column="5"><option value=""></option></select><br>
                        </div>
                        <div class="col-md-4">
                            <select class="column_filter" id="col6_filter" data-column="6"><option value=""></option></select><br>
                            <select class="column_filter" id="col8_filter" data-column="8"><option value=""></option></select><br>
                        </div>
                        <div class="col-md-4">
                            <select class="column_filter" id="col7_filter" data-column="7"><option value=""></option></select><br>
                            <select class="column_filter" id="col9_filter" data-column="9"><option value=""></option></select><br>
                        </div>
                        <!-- </div> -->
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table-product">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Item No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Brand</th>
                            <th>Group</th>
                            <th>Stock Min</th>
                            <th>Summary Stock</th>
                            <th>Price</th>
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
    <!-- /.modal -->
    <div id="mdlExcel" role="basic" class="modal fade draggable-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Import Excel</h4>
                </div>
                <div class="modal-body">
                    <form id="formExcel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" id="import_excel" name="import_excel" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green btnSubmitExcel">Import Excel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="mdlRow" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <a class="noHover" style="font-size: 18px" id="item_no"></a><br>
                                <a class="noHover bold" style="font-size: 18px" id="code"></a><br>
                                <a class="noHover bold" style="font-size: 14px" id="subcat"></a>&nbsp;<a class="noHover bold" style="font-size: 14px" id="name"></a>
                            </div>
                            <div class="col-md-6 text-right">
                                <br>
                                <a class="noHover " style="font-size: 14px" id="cat"></a>&nbsp;/&nbsp;<a class="noHover " style="font-size: 14px" id="subcat2"></a><br>
                                <a class="noHover bold" style="font-size: 14px" id="brand"></a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="main-slider" style="background: #eee;padding: 30px;">
                            <a href="https://c2.staticflickr.com/6/5499/30972532232_051e1dc57e_h.jpg" data-fancybox="images">
                                <img src="https://c2.staticflickr.com/6/5499/30972532232_e9a298a0c5_m.jpg" />
                            </a>

                            <a href="https://farm6.staticflickr.com/5551/31096145856_793c69283a_k_d.jpg" data-fancybox="images">
                                <img src="https://farm6.staticflickr.com/5551/31096145856_4915afb23e_m_d.jpg" />
                            </a>

                            <a href="https://c1.staticflickr.com/1/357/31876784275_12286240d4_h.jpg" data-fancybox="images">
                                <img src="https://c1.staticflickr.com/1/357/31876784275_fbc9696913_m.jpg" />
                            </a>

                            <a href="https://farm3.staticflickr.com/2947/33594572585_b48eba935b_k_d.jpg" data-fancybox="images">
                                <img src="https://farm3.staticflickr.com/2947/33594572585_46ca00f3a5_m_d.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <h4 class="bold">Stock Availability</h4>
                                <table id="dtlproduct" border="1" class="table nowrap table-bordered  table-checkable order-column">
                                    <thead>
                                    <tr>
                                        <th>Warehouse</th>
                                        <th>Branch</th>
                                        <th>Pcs</th>
                                        <th>Pak</th>
                                        <th>Lsn</th>
                                        <th>Ctn</th>
                                        <th>Pallet</th>
                                        <th>Cont</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-1">
                                <h4 class="bold">Unit Conversion</h4>
                                <table id="unit_con" class="table nowrap table-bordered  table-checkable order-column">
                                <tr>
                                        <td class="bold">Pak</td>
                                        <td>=</td>
                                        <td>6</td>
                                        <td>Pcs</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Lsn</td>
                                        <td>=</td>
                                        <td>12</td>
                                        <td>Pcs</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Ctn</td>
                                        <td>=</td>
                                        <td>120</td>
                                        <td>Pcs</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Pallet</td>
                                        <td>=</td>
                                        <td>360</td>
                                        <td>Pcs</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Cont</td>
                                        <td>=</td>
                                        <td>1200</td>
                                        <td>Pcs</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="width: 200px !important;" class="btn btn-circle green btnall center-block">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        function filterGlobal () {
            $('#table-product').DataTable().search(
                $('#global_filter').val()
            ).draw();
        }
        function filterColumn ( i ) {
            $('#table-product').DataTable().column( i ).search(
                $('#col'+i+'_filter').val()
            ).draw();
        }
        $(function() {
            $('#filterId').hide();
            $('#triggerShow').click(function(){
                $('#filterId').toggle();
            })

            var oTable = $('#table-product').DataTable({
                sDom: '<Rlr<"branch"><t>p>',
                colResize: {
                    resizeTable: true
                },
                autoWidth: false,
                scrollX: false,

                "pageLength": 100,
                "lengthMenu": [[100, 150, 200, 300, -1], [100, 150, 200, 300, "All"]],
//                "pagingType": "numbers",
//                "sPaginationType": "first_last_numbers",
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('product.getData') }}",
                "fnDrawCallback": function () {
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
                                        url: '{{url('api/product/deleteData/')}}/'+id,
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
                    {data: 'item_no', name: 'item_no'},
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'unit', name: 'unit'},
                    {data: 'type', name: 'type'},
                    {data: 'category', name: 'category'},
                    {data: 'subcategory', name: 'subcategory'},
                    {data: 'brand', name: 'brand'},
                    {data: 'group', name: 'group'},
                    {data: 'stock_minimum', name: 'stok_min'},
                    {data: 'summarystock', name: 'summarystock'},
                    {data: 'price', name: 'price'},
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

            $('input.global_filter').on( 'change', function () {
                filterGlobal();
            } );
            $('input.column_filter').on( 'change', function () {
                filterColumn( $(this).attr('data-column') );
            } );
            $('select.column_filter').on( 'change', function () {
                filterColumn( $(this).attr('data-column') );
            } );


            $("#col4_filter").select2({
                placeholder: "Unit",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2Unit') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });
            $("#col5_filter").select2({
                placeholder: "Type",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2Type') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });
            $("#col6_filter").select2({
                placeholder: "Category",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2Category') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });
            $("#col7_filter").select2({
                placeholder: "Sub Category",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2SubCat') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });
            $("#col8_filter").select2({
                placeholder: "Brand",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2Brand') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });
            $("#col9_filter").select2({
                placeholder: "Group",
                theme: "bootstrap",
                allowClear: true,
                ajax: {
                    url: '{{ route('product.getSelect2Group') }}',
                    dataType: "json",
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(item){
                                return {
                                    text: item.text,
                                    id: item.text
                                }
                            })
                        };
                    },
                    cache: true,
                }
            });

            $('#table-product').on('dblclick','tr',function () {
                table = "";
                console.log( oTable.row( this ).data() );
                var perrow = oTable.row( this ).data();
                $("#dtlproduct tbody").empty();
                $.get('{{url('api/product/getDataById')}}/'+perrow.id,function(msg){
                    $.each(msg.msg,function(index, value){
                        table += "<tr>"+
                                    "<td>"+value['warehouse']+"</td>"+
                                    "<td>"+value['description']+"</td>"+
                                    "<td>"+value['name']+"</td>"+
                                    "<td>"+value['unit_2_qty']+"</td>"+
                                    "<td>"+value['unit_3_qty']+"</td>"+
                                    "<td>"+value['unit_4_qty']+"</td>"+
                                    "<td>"+value['unit_5_qty']+"</td>"+
                                    "<td>"+value['total']+"</td>"+
                            "</tr>"
                    });
                    console.log(table);
                    $("#dtlproduct tbody").append(table);
                });
                document.getElementById("item_no").innerHTML = perrow.item_no;
                document.getElementById("code").innerHTML = perrow.code;
                document.getElementById("name").innerHTML = perrow.name;
                document.getElementById("cat").innerHTML = perrow.category;
                document.getElementById("subcat").innerHTML = perrow.subcategory;
                document.getElementById("subcat2").innerHTML = perrow.subcategory;
                document.getElementById("brand").innerHTML = perrow.brand;
                $("#mdlRow").modal();
            });
//            EXCEL
            var formExcel = $('#formExcel');
            $('#formExcel').validate({
                rules: {
                    import_excel: {
                        required: true
                    }
                },
                messages: {
                    import_excel: {
                        required: "Please select excel file!"
                    }
                }
            })
            $('.btnSubmitExcel').click(function () {
                if (formExcel.valid()){
                    var formSubmit = $('#formExcel')[0];
                    var data = new FormData(formSubmit);
                    $.ajax({
                        url: "{{ route('import.product') }}",
                        method: "POST",
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        datatype: "JSON",
                        enctype: 'multipart/form-data',
                        success: function (data) {
                            if (data.status == true) {
                                console.log('1');
                                $('#mdlExcel').modal('hide');
                                swal({
                                    title: data.title,
                                    text: data.text,
                                    type: data.type,
                                    confirmButtonClass: data.button
                                }, function () {
                                    location.reload();
                                })
                            }
                        }
                    })
                }
            })

        });

        $(".fancy").fancybox({
            selector : '.slick-slide:not(.slick-cloned)',
            hash     : false,
            loop : true,
            thumbs     : true
        });

        // Init Slick
        $("#main-slider").slick({
            speed:800,
            touchMove:true,
            slidesToShow   : 3,
            slidesToScroll : 3,
            infinite : true,
            dots     : true,
            arrows   : true,
            responsive : [
                {
                    breakpoint : 960,
                    settings : {
                        slidesToShow   : 1,
                        slidesToScroll : 1
                    }
                }
            ]
        });

    </script>
@endsection