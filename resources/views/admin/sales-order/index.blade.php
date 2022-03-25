@extends('template.admin')

@section('title', 'Sales Order')

@section('body')
<h1 class="font-weight-bold">Sales Order</h1>

<hr class="hr-thick" style="border-color: #707070;">

<div class="row mx-0 px-0">
	<form action="{{ route(Request::route()->getName()) }}" method="GET" class="col-5 mx-0 px-0">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search for..." name="search" value="{{$search}}">
			<div class="input-group-append">
		    	<button type="submit" data-action="none" class="btn btn-dark"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>
</div>

<div class="row mx-0 px-0">
	<div class="col-12 px-0">
		<div class="card border rounded dark-shadow h-100">
			<h3 class="card-header font-weight-bold text-custom">Sales List</h3>
			<div class="card-body mx-0 pt-0 px-0">
				{{-- TABLE --}}
				<table class="table table-striped">
					<thead>
						<tr class="font-weight-bold">
							<td>Order #</td>
							<td>Order Date</td>
							<td>Customer Name</td>
							<td>Service</td>
							<td>Product</td>
							<td>Total</td>
							<td>Description</td>
							<td></td>
						</tr>
					</thead>

					<tbody id='table-content'>
						
						@forelse($sales_order as $s)
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
							<td>
								@if (count($s->salesOrderProduct) > 2)
									@foreach ($s->salesOrderProduct as $sop)
										<b>{{$sop->product->product_name}}</b>,
									@endforeach
									...
								@elseif (count($s->salesOrderProduct) == 1)
									@foreach ($s->salesOrderProduct as $sop)
										<b>{{$sop->product->product_name}}</b>
									@endforeach
								@else
									@php ($counter = 0)
									@foreach ($s->salesOrderProduct as $sop)
										<b>{{$sop->product->product_name}}</b> {{ $counter == 0 ? '&' : '' }}
										@php ($counter++)
									@endforeach
								@endif
							</td>
							<td>{{ $s->total(true) }}</td>
							<td class="overflow-hidden cursor-pointer" data-toggle="modal" data-target="#so{{$s->id}}">{{ substr($s->description, 0, 20) }}{{ $s->description == null ? '' : (strlen($s->description) > 20 ? '...' : '') }}</td>
							<td>
								<div class="btn-group" role="group" aria-label="Actions">
									<a href="{{ route('admin.sales-order.edit', [$s->id]) }}"class="btn btn-light"><i class="fas fa-pencil-alt mr-2" title="Edit"></i></a>
									<a href="{{ route('admin.sales-order.show', [$s->id]) }}" class="btn btn-light"><i class="fas fa-eye" title="View"></i></a>
									<a href="{{ route('admin.sales-order.print', [$s->id]) }}" target="_blank" class="btn btn-light"><i class="fas fa-print" title="Print"></i></a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="9" class="text-center">No Avaiable Data in Table</td>
						</tr>
						@endforelse
						
					</tbody>
				</table>
				{{-- TABLE END --}}
			</div>
		</div>
	</div>
</div>

@foreach($sales_order as $s)
<div class="modal fade" id="so{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="so{{$s->id}}lbl" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="so{{$s->id}}lbl">SO #{{$s->id}}</h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>{{ $s->description }}</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection