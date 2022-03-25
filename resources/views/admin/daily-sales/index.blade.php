@extends('template.admin')

@section('title', 'Daily Sales Order')

@section('body')
<h1 class="font-weight-bold">Daily Sales Order</h1>

<hr class="hr-thick" style="border-color: #707070;">


<div class="row">
	<div class="col-12">
		<div class="border mx-3 p-3 rounded">
			<div class="m-4">
				<div class="row">
					<form class="col-12 col-lg-6" action="{{ route('admin.daily-sales.post') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<h3 class="font-weight-bold">Filter</h3>
						
						<div class="w-lg-50 form-group">
							<label class="form-label font-weight-bold">From Date</label>
							<input name="start_date" type="date" class="form-control" value="{{ old('start_date') ? old('start_date') : $start_date }}">
						</div>
						
						<div class="w-lg-50 form-group">
							<label class="form-label font-weight-bold">To Date</label>
							<input name="end_date" type="date" class="form-control" value="{{ old('end_date') ? old('end_date') : $end_date }}">
						</div>

						<div class="w-lg-50">
							<button type="submit" class="btn btn-secondary text-white">Filter</button>
						</div>
					</form>

					<div class="col-12 col-lg-6">
						<h3 class="font-weight-bold pb-lg-2 mb-lg-4">Actions</h3>

						<div class="row my-3">
							<form action="{{ route('admin.daily-sales.print') }}" method="POST" class="col-6" enctype="multipart/form-data" target="_blank">
								{{csrf_field()}}
								<input name="print_start_date" type="hidden" class="form-control" value="{{ old('start_date') ? old('start_date') : $start_date }}">
								<input name="print_end_date" type="hidden" class="form-control" value="{{ old('end_date') ? old('end_date') : $end_date }}">

								<button type="submit" data-action="none" class="btn btn-secondary text-white w-100 {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled cursor-default' : ''}}" {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled' : ''}}>
									Print
								</button>
							</form>

							<form action="{{ route('admin.daily-sales.pdf') }}" method="POST" class="col-6" enctype="multipart/form-data" target="_blank">
								{{csrf_field()}}
								<input name="pdf_start_date" type="hidden" class="form-control" value="{{ old('start_date') ? old('start_date') : $start_date }}">
								<input name="pdf_end_date" type="hidden" class="form-control" value="{{ old('end_date') ? old('end_date') : $end_date }}">

								<button type="submit" data-action="none" class="btn btn-secondary text-white w-100 {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled cursor-default' : ''}}" {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled' : ''}}>
									Export to PDF
								</button>
							</form>
						</div>

						<div class="row my-3">
							<form action="{{ route('admin.daily-sales.xls') }}" method="POST" class="col-6" enctype="multipart/form-data">
								{{csrf_field()}}
								<input name="xls_start_date" type="hidden" class="form-control" value="{{ old('start_date') ? old('start_date') : $start_date }}">
								<input name="xls_end_date" type="hidden" class="form-control" value="{{ old('end_date') ? old('end_date') : $end_date }}">

								<button type="submit" data-action="none" class="btn btn-secondary text-white w-100 {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled cursor-default' : ''}}" {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled' : ''}}>
									Export to XLS
								</button>
							</form>

							<form action="{{ route('admin.daily-sales.csv') }}" method="POST" class="col-6" enctype="multipart/form-data">
								{{csrf_field()}}
								<input name="csv_start_date" type="hidden" class="form-control" value="{{ old('start_date') ? old('start_date') : $start_date }}">
								<input name="csv_end_date" type="hidden" class="form-control" value="{{ old('end_date') ? old('end_date') : $end_date }}">

								<button type="submit" data-action="none" class="btn btn-secondary text-white w-100 {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled cursor-default' : ''}}" {{ ((old('start_date') == null && old('end_date') == null) && ($start_date == null && $end_date == null)) ? 'disabled' : ''}}>
									Export to CSV
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
						</tr>
						@empty
						<tr>
							<td colspan="9" class="text-center">No Available Data in Table</td>
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

@section('script')
<script type="text/javascript">
	$(document).ready(() => {
		$('[name=start_date]').on('change', (e) => {
			let obj = $(e.currentTarget);
			let target = $('[name=end_date]');
			target.attr('min', obj.val());

			if (new Date(target.val()) < new Date(obj.val()))
				target.val(obj.val());
		});
	});
</script>
@endsection