<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="robots" content="noindex, nofollow">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ucfirst(config('app.name'))}} - {{ucfirst($title)}}</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{!empty(app(App\Settings\ThemeSettings::class)->favicon) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->favicon):asset('assets/img/favicon.png')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

        @yield('styles')
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            @include('includes.frontend.header')
			<!-- /Header -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper job-wrapper">
			
				<!-- Page Content -->
                <div class="content container">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								@yield('breadcrumb')
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							@foreach($errors->all() as $error)
							<strong>Error!</strong> {{$error}}.
							@endforeach
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success! </strong>{{session('success')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
					<div class="row">
                        @yield('content')
                    </div>
                </div>

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
		
		<!-- Select2 JS -->
		<script src="{{asset('assets/js/select2.min.js')}}"></script>
		
		<!-- Datatable JS -->
		<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
		
		<!-- Datetimepicker JS -->
		<script src="{{asset('assets/js/moment.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>
		@yield('scripts')
    </body>
</html>