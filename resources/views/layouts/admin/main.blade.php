<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.style')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
    <!-- End GA -->

    <title>@yield('title')</title>
</head>
<body>
@include('sweetalert::alert')

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('layouts.admin.navbar')

        @include('layouts.admin.sidebar')

        @yield('content')

        @include('layouts.admin.footer')
    </div>
</div>

@include('layouts.admin.script')
</body>
</html>
