<!DOCTYPE html>
<html lang="en">
	<head>
		{{-- META DATA --}}
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{-- SITE META --}}
		<meta name="author" content="Code Senpai, Project on Rush">
		<meta name="type" content="website">
		<meta name="title" content="{{ env('APP_NAME') }}">
		<meta name="description" content="{{ env('APP_DESC') }}">
		<meta name="image" content="{{asset('/images/main/logo2.png')}}">
		<meta name="keywords" content="Soulace, Funeral, Parlor, Funeral Parlor">
		<meta name="application-name" content="{{ env('APP_NAME') }}">

		{{-- TWITTER META --}}
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="{{ env('APP_NAME') }}">
		<meta name="twitter:description" content="{{ env('APP_DESC') }}">
		<meta name="twitter:image" content="{{asset('/images/main/logo2.png')}}">

		{{-- OG META --}}
		<meta name="og:url" content="{{Request::url()}}">
		<meta name="og:type" content="website">
		<meta name="og:title" content="{{ env('APP_NAME') }}">
		<meta name="og:description" content="{{ env('APP_DESC') }}">
		<meta name="og:image" content="{{asset('/images/main/logo2.png')}}">

		{{-- jQuery 3.6.0 --}}
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

		{{-- jQuery UI 1.12.1 --}}
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		{{-- Removes the code that shows up when script is disabled/not allowed/blocked --}}
		<script type="text/javascript" id="for-js-disabled-js">$('head').append('<style id="for-js-disabled">#js-disabled { display: none; }</style>');$(document).ready(function() {$('#js-disabled').remove();$('#for-js-disabled').remove();$('#for-js-disabled-js').remove();});</script>

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Sweet Alert 2 --}}
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		{{-- Chart.js 3.1.1 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>

		{{-- Custom CSS --}}
		<link rel="stylesheet" href="/css/style.css">
		@yield('css')

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Input Mask 5.0.5 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

		{{-- Favicon --}}
		<link rel='icon' type='image/ico' href='{{asset("/images/main/favicon.ico")}}'>
		
		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | Admin - @yield('title')</title>
	</head>

	<body>
		{{-- SHOWS THIS INSTEAD WHEN JAVASCRIPT IS DISABLED --}}
		<div style="position: absolute; height: 100vh; width: 100vw; background-color: #ccc;" id="js-disabled">
			<style type="text/css">
				/* Make the element disappear if JavaScript isn't allowed */
				.js-only {
					display: none!important;
				}
			</style>
			<div class="row h-100">
				<div class="col-12 col-md-4 offset-md-4 py-5 my-auto">
					<div class="card shadow my-auto">
						<h4 class="card-header card-title text-center">Javascript is Disabled</h4>

						<div class="card-body">
							<p class="card-text">This website required <b>JavaScript</b> to run. Please allow/enable JavaScript and refresh the page.</p>
							<p class="card-text">If the JavaScript is enabled or allowed, please check your firewall as they might be the one disabling JavaScript.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex flex-row min-vh-100 js-only">
			{{-- NAVBAR (SIDEBAR) --}}
			<nav class="col-2 d-flex flex-column px-0 sidebar sticky-top" id="sidebar">
				{{-- Branding --}}
				<a class="navbar-brand w-100 text-center pt-4 pb-2">
					<img src="/images/main/logo2.png" class="img img-fluid w-25">
					<h6 class="text-light mt-3">Headaway Salon</h6>
				</a>

				<hr class="w-100 px-0 mx-0 border-light">

				{{-- LINKS --}}
				<div class="d-flex flex-column mx-auto" style="color: #707070!important; width: 90%;">

					@if (\Request::is('admin/dashboard'))
					<div class="sidebar-item active">
						<i class="fas fa-tachometer-alt mr-2"></i>Dashboard
					</div>
					@elseif (\Request::is('admin/dashboard/*'))
					<a class="sidebar-item active" href="{{ route('admin.dashboard') }}">
						<i class="fas fa-tachometer-alt mr-2"></i>Dashboard
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.dashboard') }}">
						<i class="fas fa-tachometer-alt mr-2"></i>Dashboard
					</a>
					@endif

					@if (\Request::is('admin/sales-order'))
					<div class="sidebar-item active">
						<i class="fas fa-percent mr-2"></i>Sales Order
					</div>
					@elseif (\Request::is('admin/sales-order/*'))
					<a class="sidebar-item active" href="{{ route('admin.sales-order.index') }}">
						<i class="fas fa-percent mr-2"></i>Sales Order
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.sales-order.index') }}">
						<i class="fas fa-percent mr-2"></i>Sales Order
					</a>
					@endif

					@if (\Request::is('admin/daily-sales'))
					<div class="sidebar-item active">
						<i class="far fa-calendar mr-2"></i>Daily Sales Report
					</div>
					@elseif (\Request::is('admin/daily-sales/*'))
					<a class="sidebar-item active" href="{{ route('admin.daily-sales.index') }}">
						<i class="far fa-calendar mr-2"></i>Daily Sales Report
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.daily-sales.index') }}">
						<i class="far fa-calendar mr-2"></i>Daily Sales Report
					</a>
					@endif

					@if (\Request::is('admin/products'))
					<div class="sidebar-item active">
						<i class="fas fa-wine-bottle mr-2"></i>Products
					</div>
					@elseif (\Request::is('admin/products/*'))
					<a class="sidebar-item active" href="{{ route('admin.products.index') }}">
						<i class="fas fa-wine-bottle mr-2"></i>Products
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.products.index') }}">
						<i class="fas fa-wine-bottle mr-2"></i>Products
					</a>
					@endif

					@if (\Request::is('admin/purchase-order'))
					<div class="sidebar-item active">
						<i class="fas fa-shopping-basket mr-2"></i>Purchase Order
					</div>
					@elseif (\Request::is('admin/purchase-order/*'))
					<a class="sidebar-item active" href="{{ route('admin.purchase-order.index') }}">
						<i class="fas fa-shopping-basket mr-2"></i>Purchase Order
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.purchase-order.index') }}">
						<i class="fas fa-shopping-basket mr-2"></i>Purchase Order
					</a>
					@endif

					@if (\Request::is('admin/receive-order'))
					<div class="sidebar-item active">
						<i class="fas fa-truck mr-2"></i>Receive Order
					</div>
					@elseif (\Request::is('admin/receive-order/*'))
					<a class="sidebar-item active" href="{{ route('admin.receiving-order.index') }}">
						<i class="fas fa-truck mr-2"></i>Receive Order
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.receiving-order.index') }}">
						<i class="fas fa-truck mr-2"></i>Receive Order
					</a>
					@endif

					@if (\Request::is('admin/suppliers'))
					<div class="sidebar-item active">
						<i class="fas fa-truck-loading mr-2"></i>Suppliers
					</div>
					@elseif (\Request::is('admin/suppliers/*'))
					<a class="sidebar-item active" href="{{ route('admin.inventory.suppliers.index') }}">
						<i class="fas fa-truck-loading mr-2"></i>Suppliers
					</a>
					@else
					<a class="sidebar-item d-block inactive" href="{{ route('admin.inventory.suppliers.index') }}">
						<i class="fas fa-truck-loading mr-2"></i>Suppliers
					</a>
					@endif

					@if(Auth::user()->type == 'admin')
						@if (\Request::is('admin/superadmin/users'))
						<div class="sidebar-item active">
							<i class="fas fa-users mr-2"></i>Users
						</div>
						@elseif (\Request::is('admin/superadmin/users/*'))
						<a class="sidebar-item active" href="{{ route('admin.users.index') }}">
							<i class="fas fa-users mr-2"></i>Users
						</a>
						@else
						<a class="sidebar-item d-block inactive" href="{{ route('admin.users.index') }}">
							<i class="fas fa-users mr-2"></i>Users
						</a>
						@endif
					@endif
				</div>

				<div class="h-100">
					<small class="text-white w-100 text-center mb-2" style="position: absolute; bottom: 0;">©2021 Headaway Salon</small>
				</div>
			</nav>

			{{-- NAVBAR (TOP) --}}
			<div class="col-10 px-0">
				<nav class="navbar navbar-expand py-0 dark-shadow" style="background-color: #FFF;">
					{{-- Hamburger Menu --}}
					<button class="btn" id="sidebar-trigger" data-target="#sidebar"><i class="fas fa-list-ul fa-lg"></i></button>

					{{-- Navbar contents --}}
					<div class="ml-auto">
						<label>
							<div class="dropdown">
								<a href='' role="button" class="nav-link dropdown-toggle text-dark dynamic-size-lg-h6" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if (Auth::check())
									{{ Auth::user()->last_name }} 
									@else
									Admin
									@endif
								</a>
								
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('home') }}">Home page</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
								</div>
							</div>
						</label>
					</div>
				</nav>

				<div class="container-fluid my-2 mx-0 px-3 row-spacing-4">
					@yield('body')
				</div>
			</div>
		</div>

		{{-- Scripts --}}
		@yield('script')

		{{-- Local Script --}}
		<script src="/js/admin.js"></script>
		<script type="text/javascript">
			@if (Session::has('flash_error'))
			Swal.fire({
				{!!Session::has('has_icon') ? "icon: `error`," : ""!!}
				title: `{{Session::get('flash_error')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#dc3545`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@elseif (Session::has('flash_info'))
			Swal.fire({
				{!!Session::has('has_icon') ? "icon: `info`," : ""!!}
				title: `{{Session::get('flash_info')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#17a2b8`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@elseif (Session::has('flash_success'))
			Swal.fire({
				{!!Session::has('has_icon') ? "icon: `success`," : ""!!}
				title: `{{Session::get('flash_success')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#28a745`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@endif
		</script>
	</body>
</html>