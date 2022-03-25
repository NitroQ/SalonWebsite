@extends('template.admin')

@section('title', 'Suppliers')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="javascript:void(0);" onclick="confirmLeave('{{route('admin.inventory.suppliers.index')}}');"><i class="fas fa-chevron-left mr-2"></i>Manage User</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<form action="{{ route('admin.inventory.suppliers.update', [$supplier->id]) }}" method="POST" class="form w-lg-50" enctype="multipart/form-data">
    {{csrf_field()}}

	<div class="row">
		<div class="form-group col-8">
			<label class="form-label font-weight-bold">Business Name</label>
			<input type="text" class="form-control" name="business_name" value="{{ $supplier->business_name }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('business_name')}}</span>
		</div>


	</div>

	<div class="row">
        <div class="form-group col-8">
			<label class="form-label font-weight-bold">Contact Number</label>
			<input type="text" class="form-control" name="contact_number" value="{{ $supplier->contact_number }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('contact_number')}}</span>
		</div>

	</div>

	<hr class="hr-thick-50 border-color-custom">

	<div class="row">
		<div class="form-group col-12">
			<label class="form-label font-weight-bold">Full Address</label>
			<input type="text" class="form-control" name="address" value="{{ $supplier->address }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('address')}}</span>
		</div>

        <div class="form-group col-12">
            <label class="form-label font-weight-bold">Description</label>
            <textarea type="text" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $supplier->description }}</textarea>
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
