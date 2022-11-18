@extends('layouts.app-master')
<title>Service</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Add Service</h3>
        <div class="container mt-2">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Service</label>
                    <input value="{{ old('service_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="service_name" 
                        placeholder="Service">

                    @if ($errors->has('service_name'))
                        <span class="text-danger text-left">{{ $errors->first('service_name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save Service</button>
                <a href="{{ route('service.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
