@extends('layouts.app-master')
<title>Profit center</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Profit center</h3>
        <div class="container mt-2">
            <div>
                Profit center: {{ $profit_center->profit_center }}
            </div>
            <div>
                Business Unit: {{ $profit_center->bu_name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('profit_center.edit', $profit_center->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('profit_center.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
