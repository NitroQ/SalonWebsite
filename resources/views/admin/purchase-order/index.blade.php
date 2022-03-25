@extends('template.admin')

@section('title', 'Purchase Order')

@section('css')
<style type="text/css">
	#table-content td {
		vertical-align: middle;
	}
</style>
@endsection

@section('body')
<h1 class="font-weight-bold">Purchase Order</h1>

<hr class="hr-thick" style="border-color: #707070;">

<div class="row mx-0 px-0">
	<form action="{{ route(Request::route()->getName()) }}" method="GET" class="col-12 col-md-5 mx-0 px-0">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search for PO..." name="search" value="{{$search}}">
			<div class="input-group-append">
		    	<button type="submit" data-action="none" class="btn btn-dark"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>

	<div class="col-12 col-md-3">
		<a href="{{ route('admin.purchase-order.create') }}" class="btn btn-success">
			<i class="fas fa-plus-circle mr-2"></i>Add Purchase Order
		</a>
	</div>
</div>

<div class="row mx-0 px-0">
	<div class="col-12 px-0">
		<div class="card border rounded dark-shadow h-100">
			<h3 class="card-header font-weight-bold text-custom">Purchase List</h3>
			<div class="card-body mx-0 pt-0 px-0">
				{{-- TABLE --}}
				<table class="table table-striped">
					<thead>
						<tr class="font-weight-bold">
							<td>Purchase Order #</td>
							<td>Order Date</td>
							<td>Supplier Name</td>
							<td>Product</td>
							<td>Total</td>
							<td>Description</td>
							<td>Status</td>
							<td></td>
						</tr>
					</thead>

					<tbody id='table-content'>
						
						@forelse($purchase_order as $p)
						<tr>
							<td class="font-weight-bold">#{{ $p->id }}</td>
							<td>{{ \Carbon\Carbon::parse($p->created_at)->format('M d, Y') }}</td>
							<td>{{ $p->supplier->business_name }}</td>
							<td>
								@if (count($p->products) > 2)
									@foreach ($p->products as $sop)
										<b>{{$sop->product_name}}</b>,
									@endforeach
									...
								@elseif (count($p->products) == 1)
									@foreach ($p->products as $sop)
										<b>{{$sop->product_name}}</b>
									@endforeach
								@else
									@php ($counter = 0)
									@foreach ($p->products as $sop)
										<b>{{$sop->product_name}}</b> {{ $counter == 0 ? '&' : '' }}
										@php ($counter++)
									@endforeach
								@endif
							</td>
							<td>{{ $p->total(true) }}</td>
							<td class="overflow-hidden cursor-pointer" data-toggle="modal" data-target="#po{{$p->id}}">{{ substr($p->description, 0, 15) }}{{ $p->description == null ? '' : (strlen($p->description) > 15 ? '...' : '') }}</td>
							<td>
								@if ($p->status == -1)
								<i class="fas fa-circle text-danger mr-2"></i>Rejected
								@elseif($p->status == 0)
								<i class="fas fa-circle text-warning mr-2"></i>Processing
								@elseif($p->status == 1)
								<i class="fas fa-circle text-info mr-2"></i>Accepted
								@elseif($p->status == 2)
								<i class="fas fa-circle text-success mr-2"></i>Delivered
								@elseif ($p->status == -2)
								<i class="fas fa-circle text-danger mr-2"></i>Cancelled
								@endif
							</td>
							<td>
											
								<div class="dropdown">
									<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
									<div class="dropdown-menu dropdown-menu-right">
										
										<a href="{{ route('admin.purchase-order.show', [$p->id]) }}" class="dropdown-item"><i class="fas fa-eye mr-2" title="View"></i>View</a>
										

										@if ($p->status == 0 )
										<a href="{{ route('admin.purchase-order.edit', [$p->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt mr-2" title="Edit"></i>Edit</a>
										@endif

										{{-- <a href="{{ route('admin.purchase-order.print', [$p->id]) }}" target="_blank" class="dropdown-item"><i class="fas fa-print mr-2" title="Print"></i>Print</a> --}}
										@if ( $p->status == 0 || $p->status == 1 )
										<a href="javascript:void(0);" onclick="confirmStatus('{{ route('admin.purchase-order.set-status', [$p->id, -2]) }}', -2);" class="dropdown-item"><i class="fas fa-ban mr-2"></i>Cancel</a>
										
										@endif

										@if ($p->status == 0 )
										<a href="{{ route('admin.purchase-order.delete', [$p->id]) }}" class="dropdown-item"><i class="fas fa-trash mr-2" title="Delete"></i>Delete</a>
										@endif
									</div>
								</div>								
								
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="8" class="text-center">No Available Data in Table</td>
						</tr>
						@endforelse
					</tbody>
				</table>
				{{-- TABLE END --}}
			</div>
		</div>
	</div>
</div>

@foreach($purchase_order as $p)
<div class="modal fade" id="po{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="po{{$p->id}}lbl" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="po{{$p->id}}lbl">SO #{{$p->id}}</h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>{{ $p->description }}</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection

@section('script')
<script type="text/javascript">
	function confirmStatus(urlTo, status) {
		
		if (status == -2)
			status = '<span class="text-info">Cancelled</span>';
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