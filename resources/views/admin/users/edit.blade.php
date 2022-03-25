@extends('template.admin')

@section('title', 'Users')

@section('body')
<h1 class="font-weight-bold"><a class="text-dark" href="javascript:void(0);" onclick="confirmLeave('{{route('admin.users.index')}}');"><i class="fas fa-chevron-left mr-2"></i>Manage User</a></h1>

<hr class="hr-thick" style="border-color: #707070;">

<form action="{{ route('admin.users.update', [$user->id] ) }}" method="POST" class="form w-lg-50" enctype="multipart/form-data">
    {{csrf_field()}}

	<div class="row">
		<div class="form-group col-6">
			<label class="form-label font-weight-bold">First Name</label>
			<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('first_name')}}</span>
		</div>

		<div class="form-group col-6">
			<label class="form-label font-weight-bold">Last Name</label>
			<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('last_name')}}</span>
		</div>

        <div class="form-group col-6">
			<label class="form-label font-weight-bold">Username</label>
			<input type="text" class="form-control" name="username" value="{{ $user->username }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('username')}}</span>
		</div>

	</div>

	<div class="row">
		<div class="form-group col-6">
			<label class="form-label font-weight-bold">Email</label>
			<input type="text" class="form-control" name="email" value="{{ $user->email }}">
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('email')}}</span>
		</div>
	</div>


	<hr class="hr-thick-50 border-color-custom">

	<div class="row">
		<div class="form-group col-6">
			<label class="form-label font-weight-bold">User Type</label>
			<select class="custom-select" name="user_type">
				<option  @if ($user->user_type == 'admin')
                    selected
                   @endif  value="admin">Admin</option>
				<option @if ($user->user_type == 'manager')
                    selected
                   @endif value="manager">Manager</option>
			</select>
			<span class="badge badge-danger w-100 validation-message">{{$errors->first('user_type')}}</span>
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
