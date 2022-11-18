@extends('layouts.app-master')
<title>Edit Region</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Update Region</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('region.update', $region->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="bu" class="form-label">Region</label>
                <input value="{{ $region->region }}" type="text" class="form-control" name="region" placeholder="Region" required>

                @if ($errors->has('region'))
                <span class="text-danger text-left">{{ $errors->first('region') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Region</button>
            <a href="{{ route('region.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection