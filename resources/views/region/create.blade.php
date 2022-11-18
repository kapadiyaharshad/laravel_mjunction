@extends('layouts.app-master')
<title>Add Region</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Add Region</h1>
        <div class="lead">
            Add Region.
        </div>

        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="bu" class="form-label">Region</label>
                    <input value="{{ old('region') }}" 
                        type="text" 
                        class="form-control" 
                        name="region" 
                        placeholder="Region" required>

                    @if ($errors->has('region'))
                        <span class="text-danger text-left">{{ $errors->first('region') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save Region</button>
                <a href="{{ route('region.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
