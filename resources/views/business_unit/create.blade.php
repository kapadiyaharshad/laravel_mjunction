@extends('layouts.app-master')
<title>Business Unit</title>
@section('content')
    <div class="bg-light p-4 rounded">

        <h3>Add Business Unit</h3>
        <div class="container mt-2">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Business Unit</label>
                    <input value="{{ old('bu_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="bu_name" 
                        placeholder="Business Unit">

                    @if ($errors->has('bu_name'))
                        <span class="text-danger text-left">{{ $errors->first('bu_name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('business_unit.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
