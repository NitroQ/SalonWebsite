@extends('template.admin')

@section('title', 'Products')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="javascript:void(0);" onclick="confirmLeave('{{route('admin.products.index')}}');"><i class="fas fa-chevron-left mr-2"></i>Manage Product</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<form action="{{ route('admin.products.store') }}" method="POST" class="form w-lg-50" enctype="multipart/form-data">
    {{csrf_field()}}

	<div class="row">
		<div class="form-group col-8">
			<label class="form-label font-weight-bold">Product Name</label>
			<input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('product_name')}}</span>
		</div>
        <div class="form-group col-8">
            <input type="number" name="in_stock" min="0" step="1" class="form-control" placeholder="Product Quantity" value="{{ old('in_stock') }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('in_stock')}}</span>
        </div>

	</div>

	<div class="row">
        <div class="form-group col-8">
            <input type="number" name="price" min="0" step=".01" class="form-control" placeholder="Product Price" value="{{ old('price') }}">
            <span class="badge badge-danger w-100 validation-message">{{$errors->first('price')}}</span>
		</div>

	</div>

	<hr class="hr-thick-50 border-color-custom">

	<div class="row">
        <div class="form-group col-12">
            <label class="form-label font-weight-bold">Description</label>
            <textarea type="text" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
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
