<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('dashbord.layouts.head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
        @php
            $user =auth()->user();
        @endphp
		@include('dashbord.layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('dashbord.layouts.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				@include('dashbord.layouts.sidebar')
				@include('dashbord.layouts.models')
				@include('dashbord.layouts.footer-scripts')
                @stack('Scripts')
    </body>
</html>
