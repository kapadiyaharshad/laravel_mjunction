@extends('layouts.app-master')
<title>Account Type</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3 col-md-6">
                    <label for="bu" class="form-label">Name</label>
                    <input value="{{ old('account_type') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name">

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="bu" class="form-label">Code</label>
                    <input value="{{ old('account_type') }}" 
                        type="text" 
                        class="form-control" 
                        name="code" 
                        placeholder="Code">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('account_type.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
