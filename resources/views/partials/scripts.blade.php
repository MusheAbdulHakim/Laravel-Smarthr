<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Slimscroll JS -->
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<!-- Select2 JS -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<!-- Datetimepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Datatable JS -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Tagsinput JS -->
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/app.js') }}"></script>
@if (isset($errors))
@foreach ($errors as $error)
{{ flash()->error(__($error)) }}
@endforeach
@endif
@vite([
    'resources/js/custom.js',
    'resources/js/app.js'
])

@livewireScripts
@stack('page-scripts')
