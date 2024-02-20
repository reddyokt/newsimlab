<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts-landing.title-meta')
    @include('layouts-landing.head')
</head>

<body>
    <div class="content-wrapper">
        @include('layouts-landing.header')
        @yield('content')
    </div>
    @include('layouts-landing.footer')
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('landing/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('landing/assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
</body>

</html>
