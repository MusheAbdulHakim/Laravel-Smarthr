<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
        <title>{{ucfirst(config('app.name'))}} - {{ucfirst($title)}}</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{!empty(app(App\Settings\ThemeSettings::class)->favicon) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->favicon):asset('assets/img/favicon.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		
<!--Moment Js-->  

        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="{{ asset('assets/plugins/plugins2/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/select2/dist/js/select2.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/plugins2/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/ckeditor5/build/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/screenfull/dist/screenfull.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/d3/dist/d3.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/c3/c3.min.js') }}"></script>
        <script src="{{ asset('assets/js/table/s.js') }}"></script>
        <script src="{{ asset('assets/js/widge/ts.js') }}"></script>
        <script src="{{ asset('assets/js/chart/s.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/plugins2/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/plugins2/JQuery-mask-plugin/jquery.mask.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/plugins2/owl.carousel/dist/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/plugins2/json-viewer/jquery.json-viewer.js')}}"></script>
        <script src="{{ asset('assets/plugins/plugins2/jquery.repeater/jquery.form-repeater.min.js')}}"></script>



		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<a href="{{route('job-list')}}" class="btn btn-primary apply-btn">Apply Job</a>
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href=""><img src="{{!empty(app(App\Settings\ThemeSettings::class)->logo) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->logo):asset('assets/img/logo.png')}}" alt="logo"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">{{$title}}</h3>
							
							<!--  Form -->
							@yield('content')
							<!-- / Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>
		
    </body>
</html>