@extends('layouts.app-master')
<title>Edit Account Type</title>
@section('content')
<div class="bg-light p-2 rounded">
    <div class="container mt-4">
        <form method="post" action="{{ route('account_type.update', $account_type->id) }}">
            @csrf
            <div class="mb-3 col-md-6">
                <label class="form-label">Name</label>
                <input value="{{ $account_type->name }}" type="text" class="form-control" name="name" placeholder="Name">

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Code</label>
                <input value="{{ $account_type->code }}" type="text" class="form-control" name="code" placeholder="Code">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('account_type.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection