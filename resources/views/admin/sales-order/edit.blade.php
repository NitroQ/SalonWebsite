@extends('template.admin')

@section('title', 'Users')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="javascript:void(0);" onclick="confirmLeave('{{route('admin.sales-order.index')}}');"><i class="fas fa-chevron-left mr-2"></i>Manage User</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<form action="{{ route('admin.sales-order.update', [$sales_order->id] ) }}" method="POST" class="form w-lg-50" enctype="multipart/form-data">
    {{csrf_field()}}

	<div class="row">
		<div class="form-group col-12">
			<label class="form-label font-weight-bold">Customer Name</label>
			<input type="text" class="form-control" name="customer_name" value="{{ $sales_order->customer_name }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('first_name')}}</span>
		</div>
        <div class="form-group col-12">
			<label class="form-label font-weight-bold">Description</label>
			<textarea class="form-control not-resizable w-100" name="description" rows="5">{{ $sales_order->description }}</textarea>
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('description')}}</span>
		</div>
    </div>


	<hr class="hr-thick-50 border-color-custom">


	<br>
	<div class="row">
		<div class="col-12">
			<button type="submit" class="btn btn-dark" data-action="submit">Save Changes</button>
		</div>
	</div>
</form>
@endsection
