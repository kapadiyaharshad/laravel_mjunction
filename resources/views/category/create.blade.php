@extends('layouts.app-master')
<title>Category</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Add Category</h3>
        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label  class="form-label">Category</label>
                    <input value="{{ old('category_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="category_name" 
                        placeholder="Category">

                    @if ($errors->has('category_name'))
                        <span class="text-danger text-left">{{ $errors->first('category_name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('category.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
