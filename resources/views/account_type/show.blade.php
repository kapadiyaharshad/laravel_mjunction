@extends('layouts.app-master')
<title>Account Type</title>
@section('content')
    <div class="bg-light p-2 rounded">
        <div class="container mt-2">
            <div>
            Name: {{ $account_type->name }}
            </div>
            <div>
            Code: {{ $account_type->code ? $account_type->code : '-'}}
            </div>
            
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('account_type.edit', $account_type->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('account_type.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
