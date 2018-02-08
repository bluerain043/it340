<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <title>Mary Gale Jabagat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Style -->
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link href="{{asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/components.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet">
    <link href="{{asset('layout/css/layout.min.css')}}" rel="stylesheet">
    <link href="{{asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet">
    <link href="{{asset('global/plugins/bootstrap-fileinput/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
    <link href="{{asset('layout/css/themes/default.min.css')}}" rel="stylesheet">
    <link href="{{asset('layout/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Script -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
    </script>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="/">
                    <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default"> </a>
                   {{-- <p class="logo-default mlast">Jabagat<span class="mlogo">MaryGale</span></p>--}}
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

                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg">
                            <span class="username username-hide-on-mobile"> {{ (Auth::user() != null) ? Auth::user()->name : ''}} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="app_todo.html">
                                    <i class="icon-rocket"></i> My Tasks
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>
                            <li>
                                <a href="page_user_login_1.html">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="{{ route('logout') }}" class="dropdown-toggle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-logout"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    {{--<li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>--}}
                    <!-- END QUICK SIDEBAR TOGGLER -->
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
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                    <li class="sidebar-search-wrapper">
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
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
                    <li class="nav-item start {{--active open--}}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                            {{--<span class="selected"></span>--}}
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(isset($allRooms) && count($allRooms) > 0)
                                @foreach($allRooms as $room)
                                    <li class="nav-item start active open">
                                        <a href="{{action('RoomController@room_view_edit', compact('room'))}}" class="nav-link ">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">{{$room->room_name}}</span>
                                           {{-- <span class="selected"></span>--}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="heading">
                        <h3 class="uppercase">Features</h3>
                    </li>

                    <li class="nav-item  {{(Route::getFacadeRoot()->current()->uri() == 'add-room') ? 'active open' : ''}}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">Rooms</span>
                            @if((Route::getFacadeRoot()->current()->uri() == 'add-room'))
                                <span class="selected"></span>
                            @else
                                <span class="arrow open"></span>
                            @endif
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  {{(Route::getFacadeRoot()->current()->uri() == 'add-room') ? 'active open' : ''}}">
                                <a href="{{action('RoomController@add_room')}}" class="nav-link">
                                    <span class="title">Add Rooms</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{action('RoomController@add_room')}}" class="nav-link ">
                                    <span class="title">List of Rooms</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-user"></i>
                            <span class="title">User</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="ui_metronic_grid.html" class="nav-link ">
                                    <span class="title">Profile</span>
                                </a>
                            </li>
                            {{--<li class="nav-item  ">
                                <a href="{{ route('create_user') }}" class="nav-link ">
                                    <span class="title">Create User</span>
                                </a>
                            </li>--}}
                            <li class="nav-item">
                                <a href="{{ route('user_list') }}" class="nav-link ">
                                    <span class="title">User's List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{(Route::getFacadeRoot()->current()->uri() == 'schedule') ? 'active open' : ''}}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-folder"></i>
                            <span class="title">Schedule</span>
                            @if((Route::getFacadeRoot()->current()->uri() == 'schedule'))
                                <span class="selected"></span>
                            @else
                                <span class="arrow open"></span>
                            @endif

                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item {{(Route::getFacadeRoot()->current()->uri() == 'schedule') ? 'open' : ''}}">
                                <a href="{{action('RoomController@schedule')}}" class="nav-link nav-toggle">
                                    <i class="icon-graph"></i> List of Schedule
                                    @if((Route::getFacadeRoot()->current()->uri() == 'schedule'))
                                        <span class="selected"></span>
                                    @else
                                        <span class="arrow open"></span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                    gale
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-puzzle"></i>
                            <span class="title">Inventory</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="components_date_time_pickers.html" class="nav-link ">
                                    <span class="title">Add</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="{{action('InventoryController@view_list')}}" class="nav-link ">
                                    <span class="title">Inventory List</span>
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-bulb"></i>
                            <span class="title">Logs</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="elements_steps.html" class="nav-link ">
                                    <span class="title">View Logs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-feed"></i>
                            <span class="title">Notification</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="layout_sidebar_menu_light.html" class="nav-link ">
                                    <span class="title">View All <br>Notification</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">Settings</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="form_controls.html" class="nav-link ">
                                            <span class="title">User Settings</span>
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
            <div class="page-content" style="min-height: 1112px;">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    @yield('breadcrumbs')
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                            <i class="icon-calendar"></i>&nbsp;
                            <span class="thin uppercase hidden-xs">{{  \Carbon\Carbon::now()->format('l j F Y')  }}</span>&nbsp;
                        </div>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                @yield('content')
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2018 © Seat Plan with Computer Inventory By
            <a target="_blank" href=javasctip;">Mary Gale Jabagat</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>

<!--[if lt IE 9]>
<script src="asset('js/respond.min.js')}}"></script>
<script src="asset('js/excanvas.min.js')}}"></script>
<script src="asset('js/ie8.fix.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{{--<script src="{{asset('global/plugins/moment.min.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{asset('global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
{{--<script src="{{asset('global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/horizontal-timeline/horizontal-timeline.js')}}" type="text/javascript"></script>--}}

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--added -->
<script src="{{asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<!-- end added -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/ui-modals.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.js')}}" type="text/javascript"></script>

@yield('page_script')
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>

</body>
</html>