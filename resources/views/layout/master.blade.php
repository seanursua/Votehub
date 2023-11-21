<!DOCTYPE html>
<html lang="en">
<head>
    @yield('HeaderScripts')
    <title>@yield('title') | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
            <div class="sidebar-bg" id="sidebar-wrapper">
                @include('layout.sidebar')
            </div>
            <div id="page-content-wrapper">
                @include('layout.navbar')
                @yield('contents') 
            </div>
            <!-- #page-content-wrapper -->
        </div>
    </div>
    @include('layout.bottombar')
    @yield('BottomScripts')
</body>
</html>