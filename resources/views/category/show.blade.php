@extends('layouts.app-master')
<title>Category</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Category</h3>
        <div class="container mt-4">
            <div>
            Category: {{ $category->category_name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('category.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
