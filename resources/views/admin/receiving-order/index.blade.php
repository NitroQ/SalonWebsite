@extends('template.admin')

@section('title', 'Receiving Order')

@section('body')
<h1 class="font-weight-bold">Receiving Order</h1>

<hr class="hr-thick" style="border-color: #707070;">

<div class="row mx-0 px-0">
	<form action="" method="GET" class="col-5 mx-0 px-0">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search for PO..." name="search" value="{{ $search }}">
			<div class="input-group-append">
		    	<button type="submit" data-action="none" class="btn btn-dark"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>
</div>

<div class="row mx-0 px-0">
	<div class="col-12 px-0">
		<div class="card border rounded dark-shadow h-100">
			<h3 class="card-header font-weight-bold text-custom">Receiving List</h3>
			<div class="card-body mx-0 pt-0 px-0">
				{{-- TABLE --}}
				<table class="table table-striped">
					<thead>
						<tr class="font-weight-bold">
							<td>PO #</td>
							<td>Order Date</td>
							<td>Supplier Name</td>
							<td>Product(s)</td>
							<td>Total</td>
							<td>Description</td>
							<td>Status</td>
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
									@if($p->status == 1)
									<i class="fas fa-circle text-info mr-2"></i>Accepted
									@elseif($p->status == 2)
									<i class="fas fa-circle text-success mr-2"></i>Delivered
									@elseif($p->status == -2)
									<i class="fas fa-circle text-danger mr-2"></i>Cancelled
									
									@endif
								</td>
								<td>
										<div class="dropdown">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
											<div class="dropdown-menu dropdown-menu-right">
												
												<a href="{{ route('admin.receiving-order.show', [$p->id]) }}" class="dropdown-item"><i class="fas fa-eye mr-2" title="View"></i>View</a>
												

												@if ( $p->status == 0 || $p->status == 1 )
												<a href="javascript:void(0);" onclick="confirmStatus('{{ route('admin.purchase-order.set-status', [$p->id, -2]) }}', -2);" class="dropdown-item"><i class="fas fa-ban mr-2"></i>Cancel</a>
												
												@endif

												@if($p->status == 1)
												<a href="javascript:void(0);" onclick="confirmStatus('{{ route('admin.receiving-order.set-status', [$p->id, 2]) }}', 2);" class="dropdown-item"><i class="fas fa-truck-loading mr-2"></i>Delivered</a>
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


@endsection

@section('script')
<script type="text/javascript">
	function confirmStatus(urlTo, status) {
		
		 if (status == 2)
			status = '<span class="text-success">Delivered</span>';
		else if (status == -2)
			status = '<span class="text-danger">Cancelled</span>';

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