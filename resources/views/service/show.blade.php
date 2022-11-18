@extends('layouts.app-master')
<title>Service</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show Service</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
            Service: {{ $service->services }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('service.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
