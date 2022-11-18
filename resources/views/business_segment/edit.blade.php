@extends('layouts.app-master')
<title>Business Segment</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Business Segment</h3>
    <div class="container mt-2">
        <form method="post" action="{{ route('business_segment.update', $business_segment->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="ec_nc" class="form-label">Business Segment</label>
                <input value="{{ $business_segment->name }}" type="text" class="form-control" name="name" placeholder="Business Segment">

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('business_segment.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection