<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skee | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin-template.css') }}">

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('administration') }}" class="logo">
            <span class="logo-mini"><b>S</b>kee</span>
            <span class="logo-lg"><b>Skee</b></span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <p> {{ auth()->user()->name }} </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">

                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        @yield('menu')
    </aside>

    @yield('content')

    <aside class="control-sidebar control-sidebar-dark" style="display: none;">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </aside>
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
{{--<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>--}}
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>


<script src="{{ asset('js/admin-template.js') }}"></script>

</body>
</html>