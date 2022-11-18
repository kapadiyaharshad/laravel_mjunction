@extends('layouts.app-master')
<title>Business Segment</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Business Segment</h3>
        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Business Segment</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name">

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('business_segment.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
