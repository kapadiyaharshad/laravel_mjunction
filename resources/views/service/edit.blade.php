@extends('layouts.app-master')
<title>Edit Service</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Update Service</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('service.update', $service->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input value="{{ $service->services }}" type="text" class="form-control" name="services" placeholder="Services" required>

                @if ($errors->has('services'))
                <span class="text-danger text-left">{{ $errors->first('services') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('service.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection