<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | {{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{DASHBOARD_META_DESCRIPTION}}" name="description" />
        <meta content="{{DASHBOARD_META_AUTHOR}}" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
        @include($ViewFolder.'.layouts.head')
    </head>
    @yield('body')
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
    @yield('content')

    @include($ViewFolder.'.layouts.footer-script')

    @include('sweetalert::alert')
    </body>
</html>