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

		{{-- Removes the code that shows up when script is disabled/not allowed/blocked --}}
		<script style="display: none;" type="text/javascript" id="for-js-disabled-js">$('head').append('<style id="for-js-disabled">#js-disabled { display: none; }</style>');$(document).ready(function() {$('#js-disabled').remove();$('#for-js-disabled').remove();$('#for-js-disabled-js').remove();});</script>

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Sweet Alert 2 --}}
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		{{-- Custom CSS --}}
		<link rel="stylesheet" href="{{asset('/css/style.css')}}">
		<style type="text/css"> * { -webkit-print-color-adjust: exact!important; } </style>

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Input Mask 5.0.5 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

		{{-- html2pdf 0.10.1 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		{{-- Favicon --}}
		<link rel='icon' type='image/ico' href='{{asset("/images/main/favicon.ico")}}'>
		
		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | Admin - Print Report</title>
	</head>

	<body>
		<div class="container-fluid my-2 mx-0 px-3 row-spacing-4">
			<h2 class="mb-3"><b>Sales Order</b> </h2>
			<h4>{{ \Carbon\Carbon::parse($start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('M d, Y') }}</h4>

			{{-- TABLE START --}}
			<table class="table m-0 p-0">
				<thead class="text-white text-center" style="background-color: rgba(112, 112, 112, 0.75);">
					<tr style="background-color: rgba(112, 112, 112, 0.75);">
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Order #</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Order Date</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Customer Name</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Service</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Total</td>
					</tr>
				</thead>

				<tbody class="text-center">
					@php ($total_sales = 0)
					@forelse ($sales_order as $s)
					<tr>
						<td>#{{ $s->id }}</td>
						<td>{{ \Carbon\Carbon::parse($s->created_at)->format('M d, Y') }}</td>
						<td>{{ $s->customer_name }}</td>
						<td>
							@if (count($s->salesOrderService) > 2)
								@foreach ($s->salesOrderService as $sos)
									<b>{{$sos->service()->service_name}}</b>,
								@endforeach
								...
							@elseif (count($s->salesOrderService) == 1)
								@foreach ($s->salesOrderService as $sos)
									<b>{{$sos->service()->service_name}}</b>
								@endforeach
							@else
								@php ($counter = 0)
								@foreach ($s->salesOrderService as $sos)
									<b>{{$sos->service()->service_name}}</b> {{ $counter == 0 ? '&' : '' }}
									@php ($counter++)
								@endforeach
							@endif
						</td>
						<td>{{ $s->total(true) }}</td>
						@php ($total_sales += $s->total())
					@empty
					<tr>
						<td colspan="9" class="text-center">No Available Data in Table</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<hr>
			<h3 class="font-weight-bold text-right">Grand Total: ₱ {{ number_format($total_sales, 2) }}</h3>
			{{-- TABLE END --}}
		</div>

		@if (Request::is('admin/daily-sales/print'))
		<script type="text/javascript">window.onload = () => { window.print() };</script>
		@elseif (Request::is('admin/daily-sales/download/pdf'))
		<script class="d-none" type="text/javascript">
			html2pdf().from($('html').html()).save("report");
		</script>
		@endif
	</body>

</html>