@extends('layouts.app-master')
<title>Add Clients</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Add Client</h1>
    <div class="container mt-2">
        <form method="POST" action="">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Client Name</label>
                    <input type="text" class="form-control" name="client_name" placeholder="Client name" value="{{ old('client_name') }}">

                    @if ($errors->has('client_name'))
                    <span class="text-danger text-left">{{ $errors->first('client_name') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">

                    @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Client code</label>
                    <input type="text" class="form-control" name="client_code" placeholder="Client code" value="{{ old('client_code') }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Contact</label>
                    <input type="text" class="form-control" name="contact" placeholder="Contact">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="mobilenum" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" name="mobilenum" placeholder="Mobile Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">

                    @if ($errors->has('mobilenum'))
                    <span class="text-danger text-left">{{ $errors->first('mobilenum') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Business Unit</label>
                    @if(count($businessUnit) > 0)
                    <select class="form-control" name="bu_name">
                        <option value="">Please select Business unit</option>
                        @foreach($businessUnit as $key=>$val)
                        <option value="{{$val->id}}" {{ old('bu_name') == $val->bu_name ? 'selected' : '' }}>{{$val->bu_name}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('bu_name'))
                    <span class="text-danger text-left">{{ $errors->first('bu_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Services</label>
                    @if(count($services) > 0)
                    <select class="form-control" name="service_name">
                        <option value="">Please select services</option>
                        @foreach($services as $key=>$val)
                        <option value="{{$val->id}}" {{ old('service_name') == $val->service_name ? 'selected' : '' }}>{{$val->service_name}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('service_name'))
                    <span class="text-danger text-left">{{ $errors->first('service_name') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="category" class="form-label">Category</label>
                    @if(count($category) > 0)
                    <select class="form-control" name="category_name">
                        <option value="">Please select category</option>
                        @foreach($category as $key=>$val)
                        <option value="{{$val->id}}" {{ old('category_name') == $val->category_name ? 'selected' : '' }}>{{$val->category_name}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('category_name'))
                    <span class="text-danger text-left">{{ $errors->first('category_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Business Segment</label>
                    @if(count($business_segment) > 0)
                    <select class="form-control" name="business_segment">
                        <option value="">Please select business segment</option>
                        @foreach($business_segment as $key=>$val)
                        <option value="{{$val->id}}" {{ old('business_segment') == $val->name ? 'selected' : '' }}>{{$val->name}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('business_segment'))
                    <span class="text-danger text-left">{{ $errors->first('business_segment') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="profit_center" class="form-label">Profit Center</label>
                    @if(count($profit_center) > 0)
                    <select class="form-control" name="profit_center">
                        <option value="">Please select profit center</option>
                        @foreach($profit_center as $key=>$val)
                        <option value="{{$val->id}}" {{ old('profit_center') == $val->profit_center ? 'selected' : '' }}>{{$val->profit_center}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('profit_center'))
                    <span class="text-danger text-left">{{ $errors->first('profit_center') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="payer_code" class="form-label">Payer Code</label>
                    @if(count($payer_code) > 0)
                    <select class="form-control" name="payer_code">
                        <option value="">Please select payer code</option>
                        @foreach($payer_code as $key=>$val)
                        <option value="{{$val->id}}" {{ old('payer_code') == $val->payer_code ? 'selected' : '' }}>{{$val->payer_code}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('payer_code'))
                    <span class="text-danger text-left">{{ $errors->first('payer_code') }}</span>
                    @endif
                </div>

                <div class="mb-3 col-md-6">
                    <label for="account_type" class="form-label">Account Type</label>
                    @if(count($account_type) > 0)
                    <select class="form-control" name="account_type">
                        <option value="">Please select account type</option>
                        @foreach($account_type as $key=>$val)
                        <option value="{{$val->id}}" {{ old('account_type') == $val->name ? 'selected' : '' }}>{{$val->name}}</option>
                        @endforeach
                    </select>
                    @endif

                    @if ($errors->has('account_type'))
                    <span class="text-danger text-left">{{ $errors->first('account_type') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option>Please select status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="deactive" {{ old('status') == 'deactive' ? 'selected' : '' }}>Deactive</option>
                    </select>
                    <span class="text-danger text-left">{{ $errors->first('account_type') }}</span>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Save Client</button>
            <a href="{{ route('client.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>

</div>
@endsection