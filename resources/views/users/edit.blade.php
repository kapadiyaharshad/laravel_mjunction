@extends('layouts.app-master')
<title>Edit User</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Update user</h1>
    <div class="container mt-2">
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="fname" class="form-label">First Name</label>
                    <input value="{{ isset($user->fname) ? $user->fname : '' }}" type="text" class="form-control" name="fname" placeholder="First Name">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="lname" class="form-label">Last Name</label>
                    <input value="{{ isset($user->lname) ? $user->lname : '' }}" type="text" class="form-control" name="lname" placeholder="Last Name">
                </div>

            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ isset($user->email) ? $user->email : '' }}" type="text" class="form-control" name="email" placeholder="Email">
                    @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="contact" class="form-label">Mobile Number</label>
                    <input value="{{ isset($user->contact) ? $user->contact : '' }}" type="text" maxlength="10" class="form-control" name="contact" placeholder="Mobile Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-control" name="role_id" id="role_id">

                        <option value="" selected disabled>Select Role</option>
                        @if(count($roles) > 0)
                        @foreach($roles as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $user->role_id) echo 'selected="selected"'; ?>>{{$value->name}}</option>
                        @endforeach
                        @endif
                    </select>


                    @if ($errors->has('role_id'))
                    <span class="text-danger text-left">{{ $errors->first('role_id') }}</span>
                    @endif
                </div>

                <!-- <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role" id="role">
                   
                    <option value="" selected disabled>Select Role</option>
                   
                    <option value="Admin">Admin</option>
                    <option value="AM">AM</option>
                  
                </select>
               

                @if ($errors->has('role'))
                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div> -->


                <div class="mb-3 col-md-6">
                    <label for="designation_id" class="form-label">Designation</label>
                    <select class="form-control" name="designation_id">
                        <option value="" selected disabled>Select Designation</option>
                        @if(count($designation) > 0)
                        @foreach($designation as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $user->designation_id) echo 'selected="selected"'; ?>>{{$value->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('designation_id'))
                    <span class="text-danger text-left">{{ $errors->first('designation_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="business_unit_id" class="form-label">Business Unit</label>
                    <select class="form-control" name="business_unit_id">
                        <option value="" selected disabled>Select Business Unit</option>
                        @if(count($businessUnit) > 0)
                        @foreach($businessUnit as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $user->business_unit_id) echo 'selected="selected"'; ?>>{{$value->bu}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('business_unit_id'))
                    <span class="text-danger text-left">{{ $errors->first('business_unit_id') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="account_type_id" class="form-label">Account Type</label>
                    <select class="form-control" name="account_type_id">
                        <option value="" selected disabled>Select Account Type</option>
                        @if(count($accountType) > 0)
                        @foreach($accountType as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $user->account_type_id) echo 'selected="selected"'; ?>>{{$value->account_type}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('account_type_id'))
                    <span class="text-danger text-left">{{ $errors->first('account_type_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="" selected disabled>Select Category</option>
                        @if(count($category) > 0)
                        @foreach($category as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $user->category_id) echo 'selected="selected"'; ?>>{{$value->category}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('category_id'))
                    <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="mnumber" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="" selected disabled>Select Status</option>
                        <option value="0" <?php if (0 == $user->status) echo 'selected="selected"'; ?>>Active</option>
                        <option value="1" <?php if (1 == $user->status) echo 'selected="selected"'; ?>>Deactivee</option>
                        <option value="2" <?php if (2 == $user->status) echo 'selected="selected"'; ?>>Deleted</option>
                        <option value="3" <?php if (3 == $user->status) echo 'selected="selected"'; ?>>Archived</option>
                    </select>
                    @if ($errors->has('status'))
                    <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
@endsection