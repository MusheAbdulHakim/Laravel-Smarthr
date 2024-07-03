<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ Vite::asset('resources/assets/img/favicon.png') }}">
@vite([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/plugins/fontawesome/css/fontawesome.min.css',
    'resources/assets/plugins/fontawesome/css/all.min.css',
    'resources/assets/css/line-awesome.min.css',
    'resources/assets/css/material.css',
    'resources/assets/css/dataTables.bootstrap4.min.css',
    'resources/assets/css/select2.min.css',
    'resources/assets/css/bootstrap-datetimepicker.min.css',
    'resources/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
    'resources/assets/scss/main.scss',
    'resources/css/app.css',
])
<!-- Vendor CSS -->
@stack('vendor-styles')
@yield('vendor-styles')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<!-- Custom CSS -->
@livewireStyles
@stack('page-styles')
@stack('style')
