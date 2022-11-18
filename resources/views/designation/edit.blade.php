@extends('layouts.app-master')
<title>Designation</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Designation</h3>
    <div class="container mt-4">
        <form method="post" action="{{ route('designation.update', $designation->id) }}">
            <!-- @method('patch') -->
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $designation->name }}" type="text" class="form-control" name="name" placeholder="Name">

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input value="{{ $designation->description }}" type="text" class="form-control" name="description" placeholder="Description">

                @if ($errors->has('description'))
                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Designation</button>
            <a href="{{ route('designation.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection