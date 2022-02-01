<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- plugins:css -->
    <link rel="stylesheet" href="/star-admin/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/star-admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/star-admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/star-admin/images/favicon.png" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/css/custom.css">


    @livewireStyles
</head>
<body>
    <div class="container-scroller"> 
        @include('includes.header_for_main')
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
                @include('includes.trainer-menu')
            <!-- partial -->
            <div class="main-panel">
                {{ $slot }}
            </div><!-- main-panel ends -->
        </div><!-- page-body-wrapper ends -->
    </div><!-- container-scroller -->
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- plugins:js -->
    <script src="/star-admin/vendors/js/vendor.bundle.base.js"></script>
    <script src="/star-admin/js/template.js"></script>
    <!-- endinject --> 
    <script src="{{ mix('js/app.js') }}" defer></script>

    @stack('scripts')
    @livewireScripts
</body>
</html>