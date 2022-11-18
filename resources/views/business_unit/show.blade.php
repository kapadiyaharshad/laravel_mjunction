@extends('layouts.app-master')
<title>Business Unit</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Business Unit</h3>
        
        <div class="container mt-4">
            <div>
            Business Unit: {{ $business_unit->bu_name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('business_unit.edit', $business_unit->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('business_unit.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
