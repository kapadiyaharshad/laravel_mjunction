@extends('layouts.app-master')
<title>Designation</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Show Designation</h3>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
            Name: {{ $designation->name }}
            <br/>
            Description: {{ $designation->description }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('designation.edit', $designation->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('designation.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
