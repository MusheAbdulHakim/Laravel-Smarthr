
@vite([
    'resources/js/core.js',
    'resources/assets/js/bootstrap.bundle.min.js',
    'resources/assets/js/select2.min.js',
    'resources/assets/js/bootstrap-datetimepicker.min.js',
    'resources/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
    'resources/assets/js/jquery.slimscroll.min.js',
    'resources/js/app.js',
    'resources/assets/js/app.js',
])
@if (isset($errors))
    @foreach ($errors as $error)
    {{ flash()->error(__($error)) }}
    @endforeach
@endif
<!-- Vendor JS -->
@livewireScripts
@yield('vendor-scripts')
@stack('page-scripts')
