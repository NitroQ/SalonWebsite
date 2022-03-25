@extends('template.admin')

@section('title', 'Sales Order')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="{{route('admin.sales-order.index')}}"><i class="fas fa-chevron-left mr-2"></i>Service Details {{$sales_order->id}}</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<div class="row mx-0 px-0">
	<div class="col-12 mx-0 px-0">
		<div class="card border rounded dark-shadow px-0">
			<h5 class="card-header">{{ $sales_order->description }}</h5>
			
			<div class="card-body p-0">
				{{-- TABLE START --}}
				<table class="table m-0 p-0">
					<thead class="text-white text-center" style="background-color: rgba(112, 112, 112, 0.75);">
						<tr>
							<td>Service</td>
							<td>Product</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Total Amount</td>
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

						<tr class="border-left">
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
			</div>
		</div>
	</div>
</div>
@endsection