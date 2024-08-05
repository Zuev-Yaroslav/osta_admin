<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-5.3.2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <span class="animation__shake">Marten</span> --}}
            <span class="animation__shake">OSTA</span>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">Выйти</button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">OSTA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin.achievement.index') }}" class="nav-link @yield('achievement')">
                                <i class="nav-icon fa-solid fa-trophy"></i>
                                <p>Достижения</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.application.index') }}" class="nav-link @yield('application')">
                                <i class="nav-icon fa-solid fa-envelope"></i>
                                <p>Заявки</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.review.index') }}" class="nav-link @yield('review')">
                                <i class="nav-icon fa-solid fa-comment"></i>
                                <p>Отзывы</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.event.index') }}" class="nav-link @yield('event')">
                                <i class="nav-icon fa-solid fa-calendar-days"></i>
                                <p>События</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.building.index') }}" class="nav-link @yield('building')">
                                <i class="nav-icon fa-solid fa-mosque"></i>
                                <p>Проекты-постройки</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mosque-history.index') }}" class="nav-link @yield('mosque-history')">
                                <i class="nav-icon fa-solid fa-mosque"></i>
                                <p>Истории мечетей</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.history.index') }}" class="nav-link @yield('history')">
                                <i class="nav-icon fa-solid fa-book"></i>
                                <p>Туган Як</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper">
            @yield('content')
        </div> --}}

        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery-3.7.1.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="{{ asset('adminlte/plugins/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/ckeditor4/adapters/jquery.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    {{-- <script src="{{ asset('adminlte/plugins/bootstrap-5.3.2/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
