<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | {{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{DASHBOARD_META_DESCRIPTION}}" name="description" />
        <meta content="{{DASHBOARD_META_AUTHOR}}" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
        @include($ViewFolder.'.layouts.head')
    </head>

    @section('body')
    @show
    <body data-sidebar="dark">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
          <!-- Begin page -->
          <div id="layout-wrapper">
            @include($ViewFolder.'.layouts.topbar')
            @include($ViewFolder.'.layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include($ViewFolder.'.layouts.footer')
            </div>
            <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include($ViewFolder.'.layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include($ViewFolder.'.layouts.footer-script')

    @include('sweetalert::alert')
    
    </body>
</html>