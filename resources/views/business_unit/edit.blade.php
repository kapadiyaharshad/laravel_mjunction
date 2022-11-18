@extends('layouts.app-master')
<title>Business Unit</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Business Unit</h3>
    <div class="container mt-4">
        <form method="post" action="{{ route('business_unit.update', $business_unit->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label class="form-label">Business Unit</label>
                <input value="{{ $business_unit->bu_name }}" type="text" class="form-control" name="bu_name" placeholder="Business Unit" required>

                @if ($errors->has('bu_name'))
                <span class="text-danger text-left">{{ $errors->first('bu_name') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('business_unit.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection