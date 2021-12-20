<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  

    <!-- Styles -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="/star-admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="/star-admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/star-admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/star-admin/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/star-admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/star-admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/star-admin/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/star-admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/star-admin/images/favicon.png" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    @livewireStyles

    {{-- <!-- Scripts -->
    <!-- plugins:js -->
    <script src="/star-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/star-admin/vendors/chart.js/Chart.min.js"></script>
    <script src="/star-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/star-admin/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/star-admin/js/off-canvas.js"></script>
    <script src="/star-admin/js/hoverable-collapse.js"></script>
    <script src="/star-admin/js/template.js"></script>
    <script src="/star-admin/js/settings.js"></script>
    <script src="/star-admin/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/star-admin/js/dashboard.js"></script>
    <script src="/star-admin/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container-scroller"> 
        @include('includes.header')
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
                @include('includes.left-menu')
            <!-- partial -->
            <div class="main-panel">
                {{ $slot }}
                @include('includes.footer')
            </div><!-- main-panel ends -->
        </div><!-- page-body-wrapper ends -->
    </div><!-- container-scroller -->
    @stack('modals')
    @stack('scripts')
    @livewireScripts
</body>
</html>