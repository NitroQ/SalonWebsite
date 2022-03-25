@extends('template.admin')

@section('title', 'Users')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="javascript:void(0);" onclick="confirmLeave('{{route('admin.purchase-order.index')}}');"><i class="fas fa-chevron-left mr-2"></i>Manage Purchase Order</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<form action="{{ route('admin.purchase-order.store') }}" method="POST" class="form" enctype="multipart/form-data">
    {{csrf_field()}}

	<div class="row">
		<div class="form-group col-12 col-md-3">
			<label class="form-label font-weight-bold">Supplier</label>
			<select class="form-control" name="supplier">
				<option value="0">-- Supplier Name --</option>
				@foreach($supplier as $s)
				<option value="{{$s->id}}" {{old('supplier') == $s->id ? 'selected' : ''}}>{{$s->business_name}}</option>
				@endforeach
			</select>
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('supplier')}}</span>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-12 col-md-3">
			<label class="form-label font-weight-bold">Description</label>
			<textarea class="form-control not-resizable w-100" name="description" rows="5">{{ old('description') }}</textarea>
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('description')}}</span>
		</div>

		<div class="form-group col-12 col-md-9">
			<label class="form-label font-weight-bold">Products</label>

			<!-- INITIALIZER INPUTS -->
			<input type="hidden" name="product_name[]" value="100">
			<input type="hidden" name="product_price[]" value="100">
			<input type="hidden" name="product_qty[]" value="100">
			<input type="hidden" name="product_description[]" value="100">

			<div class="d-flex flex-column">
				<!-- CONTAINER START -->
				<div class="d-flex flex-column" id="product-container">
					@if (old('product_name') != null && count(old('product_name')) > 1)
						@for($i = 1; $i < count(old('product_name')); $i++)
							<div class="form-group my-1 p-2 border border-secondary rounded">
								<div class="row mb-1">
									<div class="col-12 col-md-4">
										<input type="text" name="product_name[]" class="form-control" placeholder="Product Name" value="{{ old('product_name.'.$i) }}">
										<span class="badge badge-danger w-100 validation-message">{{$errors->first('product_name.'.$i)}}</span>
									</div>

									<div class="col-12 col-md-4">
										<input type="number" name="product_price[]" min="0" step=".01" class="form-control" placeholder="Product Price" value="{{ old('product_price.'.$i) }}">
										<span class="badge badge-danger w-100 validation-message">{{$errors->first('product_price.'.$i)}}</span>
									</div>

									<div class="col-12 col-md-4">
										<input type="number" name="product_qty[]" min="0" step="1" class="form-control" placeholder="Product Quantity" value="{{ old('product_qty.'.$i) }}">
										<span class="badge badge-danger w-100 validation-message">{{$errors->first('product_qty.'.$i)}}</span>
									</div>
								</div>

								<div class="row my-1">
									<div class="col-12 col-md-9">
										<textarea class="form-control not-resizable" name="product_description[]" placeholder="Product Description" rows="1">{{ old('product_description.'.$i) }}</textarea>
										<span class="badge badge-danger w-100 validation-message">{{$errors->first('product_description.'.$i)}}</span>
									</div>

									<div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
										<button type="button" class="btn btn-outline-danger h-100 w-100 remove-product"><i class="fas fa-times-circle mr-lg-2"></i><span class="d-none d-lg-inline">Remove Product</span></button>
									</div>
								</div>
							</div>
						@endfor
					@endif
				</div>
				<!-- CONTAINER END -->

				<button type="button" class="btn btn-outline-primary mt-1" id="add-product">
					<i class="fas fa-plus-circle mr-2"></i>Add Product
				</button>

				<span class="badge badge-danger w-100 validation-message">{{Session::get('product_error')}}</span>
			</div>
		</div>
	</div>

	<br>
	<div class="row">
		<div class="col-12">
			<button type="submit" class="btn btn-dark" data-action="submit">Save Changes</button>
		</div>
	</div>
</form>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(() => {
		// Removing a product entry
		$(document).on('click', '.remove-product', (e) => {
			let obj = $(e.currentTarget);
			let target = $(obj.parent().parent().parent());

			Swal.fire({
				icon: 'warning',
				html: '<h4>Are you sure?</h4><p>You cannot undo this action once confirmed.</p>',
				showDenyButton: true,
				confirmButtonText: 'Yes',
				denyButtonText: 'No'
			}).then((result) => {
				if (result.isConfirmed) {
					target.remove();
				}
			});
		});

		// Adding a product entry
		$('#add-product').on('click', (e) => {
			const form = `` +
			`<div class="form-group my-1 p-2 border border-secondary rounded">` +
				`<div class="row mb-1">` +
					`<div class="col-12 col-md-4">` +
						`<input type="text" name="product_name[]" class="form-control" placeholder="Product Name">` +
					`</div>` +
					`<div class="col-12 col-md-4">` +
						`<input type="number" name="product_price[]" min="0" step=".01" class="form-control" placeholder="Product Price">` +
					`</div>` +
					`<div class="col-12 col-md-4">` +
						`<input type="number" name="product_qty[]" min="0" step="1" class="form-control" placeholder="Product Quantity">` +
					`</div>` +
				`</div>` +
				`<div class="row my-1">` +
					`<div class="col-12 col-md-9">` +
						`<textarea class="form-control not-resizable" name="product_description[]" placeholder="Product Description" rows="1"></textarea>` +
					`</div>` +
					`<div class="col-12 col-md-3 d-flex justify-content-center align-items-center">` +
						`<button type="button" class="btn btn-outline-danger h-100 w-100 remove-product"><i class="fas fa-times-circle mr-lg-2"></i><span class="d-none d-lg-inline">Remove Product</span></button>` +
					`</div>` +
				`</div>` +
			`</div>`;

			$('#product-container').append(form);
		});
	});
</script>
@endsection