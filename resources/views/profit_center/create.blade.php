@extends('layouts.app-master')
<title>Add Profit Center</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3>Profit Center</h3>
        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Business Unit</label>
                    <select class="form-control" name="bu_name">
                        <option value="" selected disabled>Select Business Unit</option>
                        @if(count($businessUnit) > 0)
                        @foreach($businessUnit as $value)
                        <option value="{{$value->id}}">{{$value->bu_name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('bu_name'))
                    <span class="text-danger text-left">{{ $errors->first('bu_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="profit_center" class="form-label">Profit Center</label>
                    <input value="{{ old('profit_center') }}" 
                        type="number" 
                        class="form-control" 
                        name="profit_center" 
                        placeholder="Profit Center">

                    @if ($errors->has('profit_center'))
                        <span class="text-danger text-left">{{ $errors->first('profit_center') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('profit_center.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
