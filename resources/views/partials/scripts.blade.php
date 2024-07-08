@vite([
    'resources/js/app.js',
    'resources/assets/js/bootstrap.bundle.min.js',
    'resources/assets/js/jquery.slimscroll.min.js',
    'resources/assets/js/bootstrap-datetimepicker.min.js',
    'resources/assets/plugins/jquery-repeater/jquery.repeater.min.js',
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

