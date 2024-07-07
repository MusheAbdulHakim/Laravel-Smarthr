<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ Vite::asset('resources/assets/img/favicon.png') }}">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
@vite([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/plugins/fontawesome/css/fontawesome.min.css',
    'resources/assets/plugins/fontawesome/css/all.min.css',
    'resources/assets/css/line-awesome.min.css',
    'resources/assets/css/material.css',
    'resources/assets/css/bootstrap-datetimepicker.min.css',
    'resources/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css',
    'resources/assets/css/style.css',
    'resources/css/app.scss',
])
<!-- Vendor CSS -->
@stack('vendor-styles')
@yield('vendor-styles')
<!-- Custom CSS -->
@livewireStyles
@stack('page-styles')
@stack('style')