@extends('template.admin')

@section('title', 'Products')

@section('css')
<style type="text/css">
	#table-content td {
		vertical-align: middle;
	}
</style>
@endsection

@section('body')
<h1 class="font-weight-bold">Products</h1>

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
	<div class="col-2">
		<a href="{{ route('admin.products.create') }}" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Add Products</a>
	</div>
</div>

<div class="row mx-0 px-0">
	<div class="col-12 px-0">
		<div class="card border rounded dark-shadow h-100">
			<h3 class="card-header font-weight-bold text-custom">Products List</h3>
			<div class="card-body mx-0 pt-0 px-0">
				{{-- TABLE --}}
				<table class="table table-striped">
					<thead>
						<tr class="font-weight-bold">
							<td>Product Name</td>
							<td>Price</td>
                            <td>Quantity</td>
							<td>Description</td>
							<td>Status</td>
							<td></td>
						</tr>   
					</thead>

					<tbody id='table-content'>
						
						@forelse($products as $s)
						<tr>
							<td>{{ $s->product_name }} </td>
							<td>{{ $s->price }}</td>
                            <td>{{ $s->in_stock }}</td>
							<td>{{ $s->description }}</td>
							<td>@if ($s->status == 1)
                                <i class="fas fa-circle text-info mr-2"></i> In Stock
                                @elseif ($s->status == 0)
                                <i class="fas fa-circle text-danger mr-2"></i> No Stock
                                @else
                                <i class="fas fa-circle text-warning mr-2"></i> Undefined
                                @endif
                            </td>
						    <td>
								<div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.products.edit', [$s->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt mr-2" title="Edit"></i></a>
                                    <a href="{{ route('admin.products.delete',[$s->id])}}" class="btn btn-sm btn-light"><i class="fas fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="8" class="text-center">No Avaiable Data in Table</td>
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