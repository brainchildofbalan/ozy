<!DOCTYPE html>
<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="http://localhost:8001/assets/"
    data-base-url="http://localhost:8001" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Your Default Title')</title>
    <link rel="stylesheet" href="{{ asset('/assets/admin/css/main-style.css') }}">
    <script src="{{ asset('/assets/admin/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/config.js') }}"></script>

</head>

<body>

    @yield('content')

</body>


<script src="{{ asset('/assets/admin/js/jquery.js') }}"></script>
<script src="{{ asset('/assets/admin/js/popper.js') }}"></script>
<script src="{{ asset('/assets/admin/js/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/admin/js/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('/assets/admin/js/menu.js') }}"></script>
<script src="{{ asset('/assets/admin/js/main.js') }}"></script>
{{-- <script src="{{ asset('/assets/admin/js/ui-modals.js') }}"></script> --}}

</html>
