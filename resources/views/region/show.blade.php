@extends('layouts.app-master')
<title>Region</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show Region</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
            Region: {{ $region->region }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('region.edit', $region->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('region.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
