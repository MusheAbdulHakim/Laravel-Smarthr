<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<!-- Datetimepicker JS -->
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
@yield('vendor-scripts')
<!-- Custom JS -->
<script src="{{asset('assets/js/app.js')}}"></script>
@livewireScripts

@if (isset($errors))
    @foreach ($errors as $error)
    {{ flash()->error(__($error)) }}
    @endforeach
@endif
<!-- Vendor JS -->
@stack('page-scripts')
