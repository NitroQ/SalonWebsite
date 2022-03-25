@extends('template.admin')

@section('title', 'Suppliers')

@section('css')
<style type="text/css">
	#table-content td {
		vertical-align: middle;
	}
</style>
@endsection

@section('body')
<h1 class="font-weight-bold">Suppliers</h1>

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
		<a href="{{ route('admin.inventory.suppliers.create') }}" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Add Supplier</a>
	</div>
</div>

<div class="row mx-0 px-0">
	<div class="col-12 px-0">
		<div class="card border rounded dark-shadow h-100">
			<h3 class="card-header font-weight-bold text-custom">Suppliers List</h3>
			<div class="card-body mx-0 pt-0 px-0">
				{{-- TABLE --}}
				<table class="table table-striped">
					<thead>
						<tr class="font-weight-bold">
							<td>Business Name</td>
							<td>Contact</td>
							<td>Address</td>
							<td>Description</td>
							<td></td>
						</tr>
					</thead>

					<tbody id='table-content'>
						
						@forelse($suppliers as $s)
						<tr>
							<td>{{ $s->business_name }} </td>
							<td>{{ $s->contact_number }}</td>
							<td>{{ $s->address}}</td>
							<td>{{ $s->description }}</td>
						    <td>
								<div class="btn-group" role="group" aria-label="Actions">
									<a href="{{ route('admin.inventory.suppliers.edit',[$s->id])}}" class="btn btn-sm btn-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('admin.inventory.suppliers.delete',[$s->id])}}" class="btn btn-sm btn-light"><i class="fas fa-trash"></i></a>
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