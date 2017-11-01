<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Megatrend.co.id</title>
        {{--STYLE CSS--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/css/style.css') }}">
        {{--SWEETALERT--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/megatrend.css') }}">
        <link href="{{ URL::asset('metronic/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        {{--Data Dable--}}
        {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>--}}
        <link href="{{ URL::asset('metronic/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        {{--FANCYBOX--}}
        <link href="{{ URL::asset('fancybox/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css" />
        {{--SLICK--}}
        <link href="{{ URL::asset('slick/slick.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('slick/slick-theme.css')}}" rel="stylesheet" type="text/css" />
        {{--GLOBAL STYLE--}}
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap/css/bootstrap.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/css/inbox.css') }}">
        {{--PAGE LEVEL PLUGIN STYLE--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/morris/morris.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/fullcalendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/jqvmap/jqvmap/jqvmap.css') }}">
        {{--THEME GLOBAL STYLE--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/css/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/css/plugins.min.css') }}">
        {{--LAYOUT STYLE--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/layouts/layout/css/layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/layouts/layout/css/themes/darkblue.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/layouts/layout/css/custom.min.css') }}">
        {{--DATE TIME PICKER--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
        {{--<link rel="stylesheet" type="text/css" href="{{ URL::asset('metronic/') }}">--}}

        {{--SELECT2--}}
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/enhanced-modals.min.css') }}">
{{--        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mdb.css') }}">--}}
        <link href="{{ URL::asset('metronic/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('metronic/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        {{--SWEETALERT1--}}
        <script src="{{ asset('metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>

        {{--CORE PLUGINS--}}
        <script src="{{ asset('metronic/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

        {{--PAGE LEVEL PLUGINS--}}
        <script src="{{ asset('metronic/global/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/accounting.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/pages/scripts/components-select2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        {{--THEME GLOBAL SCRIPT--}}
        <script src="{{ asset('metronic/global/scripts/app.min.js') }}" type="text/javascript"></script>
        {{--PAGE LEVEL SCRIPT--}}
        <script src="{{ asset('metronic/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/enhanced-modals.min.js') }}" type="text/javascript"></script>
        {{--LAYOUT SCRIPT--}}
        <script src="{{ asset('metronic/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
        {{--DataTable--}}

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.colResize.css') }}">
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
        <script src="{{ asset('js/ColReorderWithResize.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/dataTables.colResize.js')}}" type="text/javascript"></script>

        {{--<script src="{{ asset('metronic/global/scripts/datatable.js')}}" type="text/javascript"></script>--}}
        {{--<script src="{{ asset('metronic/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>--}}
        {{--<script src="{{ asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>--}}
        {{--VALIDATION--}}
        <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
        {{--DATE TIME PICKER--}}
        <script src="{{ asset('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        {{--FANCYBOX--}}
        <script src="{{ asset('fancybox/jquery.fancybox.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fancybox/jquery.mousewheel.js') }}" type="text/javascript"></script>
        {{--SLICK--}}
        <script src="{{ asset('slick/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('slick/slick.min.js') }}" type="text/javascript"></script>


    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/logo.png') }}" style="width: 120px" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge badge-default"> 7 </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>
                                        <span class="bold">12 pending</span> notifications</h3>
                                    <a href="page_user_profile_1.html">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">just now</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">3 mins</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">10 mins</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">14 hrs</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">2 days</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">3 days</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">4 days</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">5 days</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">9 days</span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-envelope-open"></i>
                                <span class="badge badge-default"> 4 </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have
                                        <span class="bold">7 New</span> Messages</h3>
                                    <a href="app_inbox.html">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                                <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                                <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                                <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>
                                <span class="badge badge-default"> 3 </span>
                            </a>
                            <ul class="dropdown-menu extended tasks">
                                <li class="external">
                                    <h3>You have
                                        <span class="bold">12 pending</span> tasks</h3>
                                    <a href="app_todo.html">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New release v1.2 </span>
                                                        <span class="percent">30%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Application deployment</span>
                                                        <span class="percent">65%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">65% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile app release</span>
                                                        <span class="percent">98%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">98% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Database migration</span>
                                                        <span class="percent">10%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">10% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Web server upgrade</span>
                                                        <span class="percent">58%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">58% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile development</span>
                                                        <span class="percent">85%</span>
                                                    </span>
                                                <span class="progress">
                                                        <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">85% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New UI release</span>
                                                        <span class="percent">38%</span>
                                                    </span>
                                                <span class="progress progress-striped">
                                                        <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">38% Complete</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
                                <span class="username username-hide-on-mobile"> Nick </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="icon-envelope-open"></i> My Inbox
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-rocket"></i> My Tasks
                                        <span class="badge badge-success"> 7 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('logout')}}">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  pageheader--fixed page-sidebar-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px; padding-bottom: 33px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        <li class="nav-item {{ active('dashboard') }}">
                            <a href="{{ url('/') }}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="{{ Request::path() == '/' ? 'selected' : 'selected' }}"></span>

                            </a>
                        </li>
                        <li class="nav-item {{ active('report') }}">
                            <a href="{{ url('/report') }}" class="nav-link nav-toggle">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">Report</span>
                                <span class="{{ Request::path() == '/' ? 'selected' : 'selected' }}"></span>

                            </a>
                        </li>
                            <hr>
                        <li class="nav-item  {{ active(['product','stock.beginning','insert.product','detail.product','edit.product']) }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cube"></i>
                                <span class="title">Inventory</span>
                                <span class="{{ Request::is('product') || Request::is('stock.beginning') || Request::is('productType') || Request::is('productGroup') || Request::is('customergroup') || Request::is('brand') || Request::is('category') || Request::is('subCategory') || Request::is('warehouse') || Request::is('paymentTerm') || Request::is('unit.view') || Request::is('productunit.view') || Request::is('price') || Request::is('delivery') || Request::is('insert.product') || Request::is('detail.product') || Request::is('edit.product') || Request::is('insert.productunit') || Request::is('productunit.editData') || Request::is('insert.delivery') || Request::is('edit.delivery') || Request::is('warehouse.insertWarehouse') || Request::is('supplier.view') || Request::is('accountPayable') ? 'selected' : 'selected' }}"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['product','insert.product','detail.product','edit.product']) }}">
                                    <a href="{{ url('/product') }}" class="nav-link">
                                       <span class="title">Product list</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['']) }}">
                                    <a href="{{ url('#') }}" class="nav-link">

                                        <span class="title">Stock Transfer</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['']) }}">
                                    <a href="{{ url('#') }}" class="nav-link">

                                        <span class="title">Stock Opname</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('stock.beginning') }}">
                                    <a href="{{ url('/stockBeginning') }}" class="nav-link">

                                        <span class="title">Stock Beginning</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ active(['customer','view.promotion','promotion','insert.customer','detail.customer','edit.customer','salesOrder','salesReturn','salesTransaction','salesOrder.insert','salesOrder.edit','salesOrder.detail','salesTransaction.insert','salesTransaction.detail','salesTransaction.edit','salesReturn.insertSalesReturn','salesReturn.detail','salesReturn.edit']) }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="title">Sales</span>
                                <span class="selected"></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['salesTransaction','view.promotion','salesTransaction.insert','salesTransaction.detail','salesTransaction.edit']) }}">
                                    <a href="{{ url('/salesTransaction') }}" class="nav-link">

                                        <span class="title">Sales Transaction</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['salesOrder','salesOrder.insert','salesOrder.edit','salesOrder.detail']) }}">
                                    <a href="{{ url('salesOrder') }}" class="nav-link">

                                        <span class="title">Sales Order</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['']) }}">
                                    <a href="{{ url('#') }}" class="nav-link">

                                        <span class="title">SO Pending</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['customer','insert.customer','detail.customer','edit.customer']) }}">
                                    <a href="{{ url('/customer') }}" class="nav-link">

                                        <span class="title">Customer List</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['promotion']) }}">
                                    <a href="{{ url('promotion') }}" class="nav-link">
                                        <span class="title">Promotion</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['salesReturn','salesReturn.insertSalesReturn','salesReturn.detail','salesReturn.edit']) }}">
                                    <a href="{{ url('/salesReturn') }}" class="nav-link">
                                        <span class="title">Sales Return</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ active(['vendors.view','insert.vendors','vendors.editData','purchaseOrder','purchaseReturn','purchase','insert.purchase','detail.purchase','edit.purchase','detail.purchaseOrder','insert.purchaseOrder','edit.purchaseOrder','insert.purchaseReturn','detail.purchaseReturn','edit.purchaseReturn']) }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-briefcase"></i>
                                <span class="title">Purchase</span>
                                <span class="selected"></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['purchase','insert.purchase','detail.purchase','edit.purchase']) }}">
                                    <a href="{{ url('/purchase') }}" class="nav-link">

                                        <span class="title">Purchase Transaction</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['purchaseOrder','detail.purchaseOrder','edit.purchaseOrder','insert.purchaseOrder']) }}">
                                    <a href="{{ url('/purchaseOrder') }}" class="nav-link">

                                        <span class="title">Purchase Order</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['']) }}">
                                    <a href="{{ url('/purchaseReturn') }}" class="nav-link">

                                        <span class="title">List Po Pending</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['purchaseReturn','insert.purchaseReturn','detail.purchaseReturn','edit.purchaseReturn']) }}">
                                    <a href="{{ url('/purchaseReturn') }}" class="nav-link">

                                        <span class="title">Purchase Return</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['vendors.view','insert.vendors','vendors.editData']) }}">
                                    <a href="{{ url('/vendors') }}" class="nav-link">

                                        <span class="title">Vendor</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  {{ active(['arPayment','apPayment','creditNote','cnTransaction','debitNote','dnTransaction'])}}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-share-alt"></i>
                                <span class="title">Finance</span>
                                <span class="selected"></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['arPayment','creditNote','cnTransaction'])}}">
                                    <a href="javascript:" class="nav-link nav-toggle">

                                        <span class="title">AR (Account Receivable)</span>
                                        <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item {{ active(['arPayment'])}}">
                                            <a href="{{url('arPayment')}}" class="nav-link">
                                                <span class="title">AR Payment</span></a>
                                        </li>
                                        <li class="nav-item">

                                            <a href="" class="nav-link"> </i>
                                                <span class="title">AR Receipt</span></a>
                                        </li>
                                        <li class="nav-item  {{ active(['creditNote'])}}">

                                            <a href="{{url('creditNote')}}" class="nav-link">

                                                <span class="title">CN list</span></a>
                                        </li>
                                        <li class="nav-item {{ active(['cnTransaction'])}}">

                                            <a href="{{url('cnTransaction')}}" class="nav-link">
                                                <span class="title">
                                                    CN Transaction</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item {{ active(['apPayment','debitNote','dnTransaction'])}}">
                                    <a href="javascript:" class="nav-link nav-toggle">
                                        <span class="title">AP (Account Payable)</span>
                                        <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item  {{ active(['apPayment'])}}">
                                            <a href="{{url('apPayment')}}" class="nav-link">
                                                <span class="title"></i>AP Payment</span></a>
                                        </li>
                                        <li class="nav-item  {{ active(['debitNote'])}}">
                                            <a href="{{url('debitNote')}}" class="nav-link">
                                                <span class="title">Debit Note List</span></a>
                                        </li>
                                        <li class="nav-item {{ active(['dnTransaction'])}}">
                                            <a href="{{url('dnTransaction')}}" class="nav-link">
                                                <span class="title">DN Transaction</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript;" class="nav-link nav-toggle">
                                <i class="fa fa-clone"></i>
                                <span class="title">Accounting</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="">
                                       <span class="title">Expense</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="">
                                        <span class="title">Income</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="">
                                        <span class="title">General Ledger</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="">
                                        <span class="title">Coa</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ active(['employee','salesman']) }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Employee</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['employee'])}}">
                                    <a href="{{url('employee')}}" class="nav-link">
                                    <span class="title">Employee List</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['users'])}}">
                                    <a href="{{url('users')}}" class="nav-link">
                                        <span class="title">Users</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['salesman'])}}">
                                    <a href="{{url('salesman')}}" class="nav-link">
                                        <span class="title">Salesman</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  {{ active(['productType','branch','currency','productGroup','customergroup','brand','category','subCategory','warehouse','paymentTerm','unit.view','unitconversion.view','insert.unitconversion','unitconversion.editData','price','delivery','insert.product','detail.product','edit.product','insert.productunit','productunit.editData','insert.delivery','edit.delivery','warehouse.insertWarehouse','warehouse.updateWarehouse','vendorGroup','accountPayable','accountReceivable','creditNote.type','debitNote.type']) }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Master</span>
                                <span class="{{  Request::is('productType') || Request::is('productGroup') || Request::is('customergroup') || Request::is('brand') || Request::is('category') || Request::is('subCategory') || Request::is('warehouse') || Request::is('paymentTerm') || Request::is('unit.view') || Request::is('productunit.view') || Request::is('price') || Request::is('delivery') || Request::is('insert.product') || Request::is('detail.product') || Request::is('edit.product') || Request::is('insert.productunit') || Request::is('productunit.editData') || Request::is('insert.delivery') || Request::is('edit.delivery') || Request::is('warehouse.insertWarehouse') || Request::is('supplier.view') || Request::is('accountPayable') ? 'selected' : 'selected' }}"></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item {{ active(['category','brand','productType','insert.product','detail.product','edit.product']) }}">
                                        <a href="javascript;" class="nav-link nav-toggle">
                                            <i class="fa fa-book"></i>
                                            <span class="title">Product</span>
                                            <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item {{ active('category') }}">
                                            <a href="{{ url('/category') }}" class="nav-link">
                                                <i class="fa fa-cloud"></i>
                                                <span class="title">Category</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active('subCategory') }}">
                                            <a href="{{ url('/subCategory') }}" class="nav-link">
                                                <i class="fa fa-cloud-download"></i>
                                                <span class="title">Sub Category</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active('brand') }}">
                                            <a href="{{ url('/brand') }}" class="nav-link">
                                                <i class="fa fa-gg-circle"></i>
                                                <span class="title">Brand</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active('productType') }}">
                                            <a href="{{ url('/productType') }}" class="nav-link">
                                                <i class="fa fa-cart-plus"></i>
                                                <span class="title">Type</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active('productGroup') }}">
                                            <a href="{{ url('/productGroup') }}" class="nav-link">
                                                <i class="fa fa-industry"></i>
                                                <span class="title">Group</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active('unit.view') }}">
                                            <a href="{{ url('/unit') }}" class="nav-link">
                                                <i class="fa fa-map-signs"></i>
                                                <span class="title">Unit</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ active(['unitconversion.view','insert.unitconversion','unitconversion.editData']) }}">
                                            <a href="{{ url('/unitconversion') }}" class="nav-link">
                                                <i class="fa fa-balance-scale"></i>
                                                <span class="title">Unit Conversion</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item {{ active('customergroup') }}">
                                    <a href="{{ url('/customerGroup') }}" class="nav-link">
                                        <i class="fa fa-cloud-download"></i>
                                        <span class="title">Customer Group</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('vendorGroup') }}">
                                    <a href="{{ url('/vendorGroup') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">Vendor Group</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('branch') }}">
                                    <a href="{{ url('/branch') }}" class="nav-link">
                                        <i class="fa fa-gg-circle"></i>
                                        <span class="title">Branch</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('currency') }}">
                                    <a href="{{ url('/currency') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">Currency</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('creditNote.type') }}">
                                    <a href="{{ url('/creditNoteType') }}" class="nav-link">
                                        <i class="fa fa-book"></i>
                                        <span class="title">Credit Note Type</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('debitNote.type') }}">
                                    <a href="{{ url('/debitNoteType') }}" class="nav-link">
                                        <i class="fa fa-book"></i>
                                        <span class="title">Debit Note Type</span>
                                    </a>
                                </li>


                                <li class="nav-item {{ active('price') }}">
                                    <a href="{{ url('/price') }}" class="nav-link">
                                        <i class="icon-wallet"></i>
                                        <span class="title">Selling Price</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['delivery','insert.delivery','edit.delivery']) }}">
                                    <a href="{{ url('/delivery') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">Shipping Method</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active(['warehouse','warehouse.insertWarehouse','warehouse.updateWarehouse']) }}">
                                    <a href="{{ url('/warehouse') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">Warehouse</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('paymentTerm') }}">
                                    <a href="{{ url('/paymentTerm') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">Payment Term</span>
                                    </a>
                                </li>

                                <li class="nav-item {{ active('vendorGroup') }}">
                                    <a href="{{ url('/vendorGroup') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">COA Type</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('coaPivotParent') }}">
                                    <a href="{{ url('/coaPivotParent') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">COA Pivot Parent</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ active('coaControl') }}">
                                    <a href="{{ url('/coaControl') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">COA Control</span>
                                    </a>
                                </li>

                                <li class="nav-item {{ active('coalist') }}">
                                    <a href="{{ url('/coalist') }}" class="nav-link">
                                        <i class="icon-notebook"></i>
                                        <span class="title">COA list</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{ route('report') }}" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Report</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ route('jsReport',1) }}" class="nav-link ">
                                        <span class="title">Js Report Invoice</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ route('jsReportNeraca') }}" class="nav-link ">
                                        <span class="title">Js Report Neraca</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ route('jsReportLabaRugi') }}" class="nav-link ">
                                        <span class="title">Js Report Laba Rugi</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ route('jsDesign') }}" class="nav-link ">
                                        <span class="title">Js Report Design</span>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Recycle bin</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{url('recycle/product')}}" class="nav-link ">
                                        <span class="title">Product</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-wrench"></i>
                                <span class="title">Setting</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{url('/productCoa')}}" class="nav-link ">
                                        <span class="title">Product Coa</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

                    {{--ISI--}}
                    @yield('content')

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->


        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        {{--<div class="page-footer">--}}
            {{--<div class="page-footer-inner">Megatrend</div>--}}
            {{--<div class="scroll-to-top">--}}
                {{--<i class="icon-arrow-up"></i>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- END FOOTER -->
    </div>
    </body>
</html>
