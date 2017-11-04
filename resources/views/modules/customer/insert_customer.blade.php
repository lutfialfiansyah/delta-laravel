@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.customer') !!}</a>
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
    <h1 class="page-title"> Insert Customer
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->
                <!-- BEGIN FORM-->
                <form action="" id="formcustomer" method="" class="horizontal-form">
                  <div class="tab-pane" id="tab_1">
                      <div class="tabbable-line boxless tabbable-reversed">
                          <ul class="nav nav-tabs">
                              <li class="active" style="background-color: #36c6d3;">
                                  <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Insert Customer</a>
                              </li>
                          </ul>
                          <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;">
                              <div class="tab-pane active" id="tab_0">
                                  <div class="portlet box">
                                      <div class="portlet-title">
                                      </div>
                                      <div class="portlet-body form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Code</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                                <input required  readonly type="text" value="{{$code}}" id="code" name="code" class="form-control" placeholder="S001">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                      <div class="form-group">
                                                          <label class="control-label col-sm-2">Name</label>
                                                          <div class="col-md-8">
                                                              <div class="input-group" style="width: 100%;">
                                                                  <input type="text" id="name" required name="name" class="form-control" placeholder="-">
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2">Tax No</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group" style="width: 100%;">
                                                            <input required type="text" value="" id="" name="tax_no" class="form-control" placeholder="S001">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                  <div class="form-group">
                                                      <label class="control-label col-sm-2">Branch</label>
                                                      <div class="col-md-8">
                                                          <div class="input-group" style="width: 100%;">
                                                            <select  required class="form-control select2" name="branch">
                                                                <option value="">Choose a branch</option>
                                                                @foreach($branch as $row)
                                                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Customer Group</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                              <select class="form-control" required name="customer_group">
                                                                  <option value="">Choose a Customer Group</option>
                                                                  @foreach($customerGroups as $customerGroup)
                                                                      <option value="{{$customerGroup->id}}">{{$customerGroup->name}}</option>
                                                                  @endforeach
                                                              </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                      <div class="form-group">
                                                          <label class="control-label col-sm-2">Area</label>
                                                          <div class="col-md-8">
                                                              <div class="input-group" style="width: 100%;">
                                                                <select class="form-control" required name="area">
                                                                    <option value="1">Choose a Area</option>
                                                                </select>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>

                                      <div class="row">
                                          <div class="col-sm-6">
                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                  <div class="form-group">
                                                      <label class="control-label col-sm-2">Salesman</label>
                                                      <div class="col-md-8">
                                                          <div class="input-group" style="width: 100%;">
                                                            <select class="form-control" required name="salesman" tabindex="1">
                                                                <option value="">Choose a Salesman</option>
                                                                @foreach($salesman as $row)
                                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Payment term</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                              <select class="form-control" required name="payment_term"  tabindex="1">
                                                                  <option value="">Choose a Payment Term</option>
                                                                  @foreach($paymentterms as $paymentterm)
                                                                      <option value="{{$paymentterm->id}}">{{$paymentterm->name}} | {{$paymentterm->total_period}} | {{$paymentterm->percent_discount}}% | {{$paymentterm->discount_period}}</option>
                                                                  @endforeach
                                                              </select>
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
                        <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="tabbable-line boxless tabbable-reversed">
                                    <ul class="nav nav-tabs">
                                        <li class="active" style="background-color: #36c6d3;">
                                            <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Contact Person</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;">
                                        <div class="tab-pane active" id="tab_0">
                                              <div class="portlet-body form">
                                                <div class="portlet box">
                                                    <div class="portlet-title">
                                                    </div>
                                                    <div class="portlet-body form">
                                                      <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                              <div class="form-group">
                                                                  <label class="control-label col-sm-2">Contact Person</label>
                                                                  <div class="col-md-8">
                                                                      <div class="input-group" style="width: 100%;">
                                                                        <input required type="text" value="" id="" name="contact_person" class="form-control" placeholder="S001">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                      </div>


                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Address</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <textarea row="5" name="address" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Email</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <input required type="text" value="" id="" name="email" class="form-control" placeholder="xxx@xxx.xx.xx">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Work Phone</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <input required type="text" value="" id="" name="work_phone1" class="form-control" placeholder="089089999xxx">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Work Phone 2</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <input required type="text" value="" id="" name="work_phone2" class="form-control" placeholder="089089999xxx">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Work fax</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <input required type="text" value="" id="" name="work_fax" class="form-control" placeholder="089089999xxx">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                          <div class="col-sm-12">
                                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-2">Total Employee</label>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group" style="width: 100%;">
                                                                          <input required type="text" value="" id="" name="total_employee" class="form-control" placeholder="500">
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
                            <div class="tabbable-line boxless tabbable-reversed">
                                <ul class="nav nav-tabs">
                                    <li class="active" style="background-color: #36c6d3;">
                                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Owner Info</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="border: #ccc solid 1px;padding-top: 0px;">
                                    <div class="tab-pane active" id="tab_0">
                                      <div class="portlet box">
                                          <div class="portlet-title">
                                          </div>
                                          <div class="portlet-body form">


                                            <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Owner Name</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input required type="text" value="" id="" name="owner_name" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Owner Phone</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input required type="text" value="" id="" name="owner_phone" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-sm-12">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">owner email</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input required type="text" value="" id="" name="owner_email" class="form-control" placeholder="">
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
                        </div>
                        <div class="form-actions right" style="margin-top:10px">
                            <center>
                            <button type="button" class="btn green btnsaveproduct">
                                <i class="fa fa-check"></i> Save</button>
                              </center>
                        </div>
                      </div>

                </form>
    <script type="text/javascript">
            $(function(){
                var form = $('#formcustomer');
                $('#formcustomer').validate()
                $('.btnsaveproduct').click(function () {
                    var urls = '{{route('customer.addData')}}'
                    if(form.valid()) {
                        $.ajax({
                            url: urls,
                            type: 'POST',
                            data: $('#formcustomer').serialize(),
                            datatype: 'json',
                            success: function (data) {
                                console.log(data)
                                //alert(data.msg);

                                //location.reload();
                                swal({
                                        title: data.title,
                                        text: data.msg,
                                        type: data.type,
                                        confirmButtonClass: 'btn btn-success'
                                    }, (function () {
                                        if (data.status == true) {
                                            location.href = '{{url('customer')}}'
                                        }
                                    })
                                )
                            }
                        })
                    }
                })
            })
    </script>
@endsection
