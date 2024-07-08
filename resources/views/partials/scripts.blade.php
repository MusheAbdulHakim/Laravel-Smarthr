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
<script type="module">
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
                className: "danger",
            }).showToast();
            break;
        @endforeach
    @endif
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', '') }}";
        switch (type) {
            case 'info':
                Toastify({
                    text: "{{ Session::get('message') }}",
                    className: "info",
                }).showToast();
                break;
            
            case 'success':
                Toastify({
                    text: "{{ Session::get('message') }}",
                    className: "success",
                }).showToast();
                break;
            
            case 'warning':
                Toastify({
                    text: "{{ Session::get('message') }}",
                    className: "warning",
                }).showToast();
                break;
            
            case 'error':
                Toastify({
                    text: "{{ Session::get('message') }}",
                    className: "danger",
                }).showToast();
                break;
            
            case 'danger':
                Toastify({
                    text: "{{ Session::get('message') }}",
                    className: "danger",
                }).showToast();
                break;
            
        }
    @endif
</script>
