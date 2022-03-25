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
		<script type="text/javascript" id="for-js-disabled-js">$('head').append('<style id="for-js-disabled">#js-disabled { display: none; }</style>');$(document).ready(function() {$('#js-disabled').remove();$('#for-js-disabled').remove();$('#for-js-disabled-js').remove();});</script>

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Sweet Alert 2 --}}
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		{{-- Custom CSS --}}
		<link rel="stylesheet" href="/css/style.css">
		<style type="text/css"> * { -webkit-print-color-adjust: exact!important; } </style>

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Input Mask 5.0.5 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

		{{-- Favicon --}}
		<link rel='icon' type='image/ico' href='{{asset("/images/main/favicon.ico")}}'>
		
		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | Admin - Print SO#{{$sales_order->id}}</title>
	</head>

	<body>
		<div class="container-fluid my-2 mx-0 px-3 row-spacing-4">
			<h3 class="mb-3">Sales Order #{{ $sales_order->id }}</h3>

			{{-- TABLE START --}}
			<table class="table m-0 p-0">
				<thead class="text-white text-center" style="background-color: rgba(112, 112, 112, 0.75);">
					<tr style="background-color: rgba(112, 112, 112, 0.75);">
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Service</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Product</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Price</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Quantity</td>
						<td style="background-color: rgba(112, 112, 112, 0.75)!important;">Total Amount</td>
					</tr>
				</thead>

				<tbody class="text-center">
					@php ($subtotal = 0)
					@foreach ($sales_order->salesOrderProduct as $sop)
					<tr>
						<td></td>
						<td>{{$sop->product->product_name}}</td>
						<!-- <td>₱{{number_format($sop->product->price, 2)}}</td> -->
						<td></td>
						<td>{{$sop->quantity}}</td>
						<!-- <td>₱{{number_format($sop->product->price * $sop->quantity, 2)}}</td> -->
						<td></td>
					</tr>
					@endforeach

					@foreach ($sales_order->salesOrderService as $sos)
					<tr>
						<td>{{$sos->service()->service_name}}{{ $sos->serviceVariation->variation_name == null ? '' : ' - ' . $sos->serviceVariation->variation_name }}</td>
						<td></td>
						<td>₱{{number_format($sos->getPrice(), 2)}}</td>
						<td>{{$sos->quantity}}</td>
						<td>₱{{number_format($sos->price * $sos->quantity, 2)}}</td>
						@php ($subtotal += $sos->price * $sos->quantity)
					</tr>
					@endforeach

					<tr>
						<td colspan="3" rowspan="4"></td>
						<td class="border-left">Subtotal:</td>
						<td>₱{{number_format($subtotal, 2)}}</td>
					</tr>

					<tr>
						<td class="border-left">Tax:</td>
						<td>₱{{number_format($subtotal * 0.12, 2)}}</td>
					</tr>

					<tr>
						<td class="font-weight-bold border-left">Grand Total:</td>
						<td class="font-weight-bold">₱{{number_format($subtotal + ($subtotal * 0.12), 2)}}</td>
					</tr>
				</tbody>
			</table>
			{{-- TABLE END --}}

			<h5 class="my-5">Remarks/Description/Note:</h5>
			<p>{{ $sales_order->customer_name }}</p>
			<p>{{ $sales_order->description }}</p>
		</div>

		<script type="text/javascript">window.onload = () => { window.print() };</script>
	</body>
</html>