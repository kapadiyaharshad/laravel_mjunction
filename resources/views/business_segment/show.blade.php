@extends('layouts.app-master')
<title>Business Segment</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Business Segment</h3>
        <div class="container mt-2">
            <div>
            Business Segment: {{ $business_segment->name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('business_segment.edit', $business_segment->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('business_segment.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
