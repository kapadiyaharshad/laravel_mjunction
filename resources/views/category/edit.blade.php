@extends('layouts.app-master')
<title>Category</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Category</h3>
    <div class="container mt-4">
        <form method="post" action="{{ route('category.update', $category->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input value="{{ $category->category_name }}" type="text" class="form-control" name="category_name" placeholder="Category">

                @if ($errors->has('category_name'))
                <span class="text-danger text-left">{{ $errors->first('category_name') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('category.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection