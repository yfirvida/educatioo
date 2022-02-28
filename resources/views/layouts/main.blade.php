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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
    <script src="/star-admin/js/template.js"></script>
    <!-- endinject --> 
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/custom.js') }}" defer></script>

    @stack('scripts')
    @livewireScripts
</body>
</html>