@extends('layouts.app-master')
<title>Add Users</title>
@section('content')
<div class="bg-light rounded">
    <h3>Add new user</h3>
    <div class="container mt-1">
        <form method="POST" action="">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="fname" class="form-label">First Name</label>
                    <input value="{{ old('fname') }}" type="text" class="form-control" name="fname" placeholder="First Name">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="lname" class="form-label">Last Name</label>
                    <input value="{{ old('lname') }}" type="text" class="form-control" name="lname" placeholder="Last Name">
                </div>

            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="Email">
                    @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="contact" class="form-label">Mobile Number</label>
                    <input value="{{ old('contact') }}" type="text" maxlength="10" class="form-control" name="contact" placeholder="Mobile Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-control" name="role_id" id="role_id">

                        <option value="" selected disabled>Select Role</option>
                        @if(count($roles) > 0)
                        @foreach($roles as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
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

                <div class="mb-3 col-md-6" id="account_type_div">
                    <label for="account_type" class="form-label">Account Type</label>
                    <select id='account_type' class='form-select chosen-select' name='account_type[]' multiple data-placeholder='Select Account Type'>
                        <!-- <option value="" selected disabled>Select Account Type</option> -->
                        @if(count($accountType) > 0)
                        @foreach($accountType as $value)
                        <option value="<?php echo $value->account_type ?>"><?php echo $value->account_type ?></option>
                        @endforeach
                        @endif
                    </select>

                    @if ($errors->has('account_type'))
                    <span class="text-danger text-left">{{ $errors->first('account_type') }}</span>
                    @endif
                </div>


                <div class="mb-3" id="business_user_div">
                    <label for="business_user" class="form-label">Business Unit</label>
                    <select id='business_user' class='form-select chosen-select' name='business_user[]' multiple data-placeholder='Select Business Unit'>
                        <!-- <option value="" selected disabled>Select Account Type</option> -->
                        @if(count($businessUnit) > 0)
                        @foreach($businessUnit as $val)
                        <option value="<?php echo $val->bu ?>"><?php echo $val->bu ?></option>
                        @endforeach
                        @endif
                    </select>

                    @if ($errors->has('business_user'))
                    <span class="text-danger text-left">{{ $errors->first('business_user') }}</span>
                    @endif
                </div>


               
                <div class="mb-3 col-md-6">
                    <label for="designation_id" class="form-label">Designation</label>
                    <select class="form-control" name="designation_id">
                        <option value="" selected disabled>Select Designation</option>
                        @if(count($designation) > 0)
                        @foreach($designation as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
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
                        <option value="{{$value->id}}">{{$value->bu_name}}</option>
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
                        <option value="{{$value->id}}">{{$value->name}}</option>
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
                        <option value="{{$value->id}}">{{$value->category}}</option>
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
                        <option value="0">Active</option>
                        <option value="1">Deactivee</option>
                        <option value="2">Deleted</option>
                        <option value="3">Archived</option>
                    </select>
                    @if ($errors->has('status'))
                    <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#account_type_div').hide();
        $("#business_user_div").hide();
        $('#account_type').chosen({
            width: '800px'
        });
        $('#business_user').chosen({
            width: '800px'
        });
        //show on select 
        $('#role_id').on('change', function() {
            var selectData = $(this).val();
            if (selectData == 'AM' || selectData == 'RM') {
                $('#account_type_div').show();
                $("#business_user_div").hide();
            }
            if (selectData == 'BU') {
                $('#account_type_div').hide();
                $("#business_user_div").show();
            }
            if (selectData == 'superadmin' || selectData == 'CU') {
                $('#account_type_div').hide();
                $("#business_user_div").hide();
            }
        });
    });
</script>
@endsection