@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="">{!! Breadcrumbs::render('insert.vendors') !!}</a>
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
    <form action="{{url('/vendors/addData')}}" id="formvendors" method="post" class="horizontal-form">
        {{ csrf_field() }}
        <div class="tab-pane" id="tab_1">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active" style="background-color: #36c6d3;">
                        <a href="#tab_0" data-toggle="tab" aria-expanded="true" class="bold">Insert Vendor</a>
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
                                                      <input required type="text" id="name" name="name" class="form-control" placeholder="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row" style="margin-top:10px; ">
                                      <div class="col-sm-6">
                                          <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                              <div class="form-group">
                                                  <label class="control-label col-sm-2">Vendor Group</label>
                                                  <div class="col-md-8">
                                                      <div class="input-group" style="width: 100%;">
                                                        <select required id="vendor_group" name="vendor_group_id" style="width: 100%;" class="form-control select2">
                                                            <option></option>
                                                            @foreach($vendorgroup as  $vg)
                                                                <option value="{{ $vg->id }}">{{ $vg->name }}</option>
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
                                                    <label class="control-label col-sm-2">Payemnt Term</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group" style="width: 100%;">
                                                          <select required id="payment" name="payment_term_id" class="form-control select2">
                                                              <option></option>
                                                              @foreach($pay as  $pays)
                                                                  <option value="{{ $pays->id }}">{{ $pays->name }}</option>
                                                              @endforeach
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                      </div>


                                      <div class="row" style="margin-top:10px; ">
                                          <div class="col-sm-6">
                                              <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                  <div class="form-group">
                                                      <label class="control-label col-sm-2">Area</label>
                                                      <div class="col-md-8">
                                                          <div class="input-group" style="width: 100%;">
                                                            <select required id="area" name="area_id" class="form-control select2">
                                                                <option value=""></option>
                                                                <option selected value="3">Tiga</option>
                                                            </select>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2">Payemnt Term</label>
                                                        <div class="col-md-8">
                                                            <div class="input-group" style="width: 100%;">
                                                                <textarea class="form-control autosizeme" rows="3" placeholder="-" name="address"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                          </div>


                                          <div class="row" style="margin-top:10px; ">
                                              <div class="col-sm-6">
                                                  <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                      <div class="form-group">
                                                          <label class="control-label col-sm-2">Phone 1</label>
                                                          <div class="col-md-8">
                                                              <div class="input-group" style="width: 100%;">
                                                                <input required type="text" id="name" name="phone_1" class="form-control" placeholder="-">
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-2">phone 2</label>
                                                            <div class="col-md-8">
                                                                <div class="input-group" style="width: 100%;">
                                                                  <input required type="text" id="name" name="phone_2" class="form-control" placeholder="-">
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>


                                              <div class="row" style="margin-top:10px; ">
                                                  <div class="col-sm-6">
                                                      <div class="row" style="margin-top: 10px;margin-left: 10px;">
                                                          <div class="form-group">
                                                              <label class="control-label col-sm-2">Email</label>
                                                              <div class="col-md-8">
                                                                  <div class="input-group" style="width: 100%;">
                                                                    <input required type="text" id="name" name="email" class="form-control" placeholder="-">
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>


                            </div>

                          </div>

                    </div>
                    <div class="form-actions">
                      <center>
                        <button type="submit" class="btn green btnsavevendors">
                            <i class="fa fa-check"></i> Save</button>
                          </button>
                    </div>
                  </div>
                </div>
              </div>
      </form>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#vendor_group").select2({
                placeholder: "Choose a Vendor Group",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
            });
            $("#area").select2({
                placeholder: "Choose a Area",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
                width: '100%'
            });
            $("#payment").select2({
                placeholder: "Choose a Payment",
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 3,
                dropdownAutoWidth: true,
                width: '100%'
            });
        });
    </script>
@endsection
