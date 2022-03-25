@extends('template.admin')

@section('title', 'Receive Order')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="{{route('admin.receiving-order.index')}}"><i class="fas fa-chevron-left mr-2"></i>Receiving Order Details {{$purchase_order->id}}</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<div class="row mx-0 px-0">
	<div class="col-12 mx-0 px-0">
		<div class="card border rounded dark-shadow px-0">
			<h5 class="card-header">
				<div class="row">
					<div class="col-12 col-lg-6 d-flex flex-row align-items-center">
							{{ $purchase_order->description }}
					</div>

					<div class="col-12 col-lg-6 text-right">
						<div class="row mb-1">
							<div class="col-6 ml-auto"> 
								@if ($purchase_order->status == -1)
								<i class="fas fa-circle text-danger mr-2"></i>Rejected
								@elseif($purchase_order->status == 0)
								<i class="fas fa-circle text-warning mr-2"></i>Processing
								@elseif($purchase_order->status == 1)
								<i class="fas fa-circle text-info mr-2"></i>Accepted
								@elseif($purchase_order->status == 2)
								<i class="fas fa-circle text-success mr-2"></i>Delivered
								@endif
							</div>
						</div>

						<div class="row mt-1">
							<div class="col-6 ml-auto"> 
								<div class="btn-group"> 
								 @if($purchase_order->status == 1)
									<a href="javascript:void(0);" onclick="confirmStatus('{{ route('admin.purchase-order.set-status', [$purchase_order->id, 2]) }}', 2);" class="btn btn-sm btn-outline-success"><i class="fas fa-truck-loading mr-2"></i>Delivered</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</h5>
			
			<div class="card-body p-0">
				{{-- TABLE START --}}
				<table class="table m-0 p-0">
					<thead class="text-white text-center" style="background-color: rgba(112, 112, 112, 0.75);">
						<tr>
							<td>Items</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Total Amount</td>
						</tr>
					</thead>

					<tbody class="text-center">
						@php ($subtotal = 0)
						@foreach ($purchase_order->products as $p)
						<tr>
							<td>{{$p->product_name}}</td>
							<td>₱{{number_format($p->price, 2)}}</td>
							<td>{{$p->quantity}}</td>
							<td>₱{{number_format($p->price * $p->quantity, 2)}}</td>
							@php ($subtotal += $p->price * $p->quantity)
						</tr>
						@endforeach

						<tr class="border-left">
							<td colspan="2" rowspan="4"></td>
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

@section('script')
<script type="text/javascript">
	function confirmStatus(urlTo, status) {
		if (status == -1)
			status = '<span class="text-danger">Rejected</span>';
		else if (status == 0)
			status = '<span class="text-warning">Processing</span>';
		else if (status == 1)
			status = '<span class="text-info">Accepted</span>';
		else if (status == 2)
			status = '<span class="text-success">Delivered</span>';

		Swal.fire({
			icon: 'warning',
			html: '<h4>Confirm Action</h4><p>You\'re about to set the status to ' + status + '</p>',
			showDenyButton: true,
			confirmButtonText: 'Yes',
			denyButtonText: 'No'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = urlTo;
			}
		});
	}
</script>
@endsection