@extends('layouts.app-master')
<title>Payer Code</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Payer code</h3>
    <div class="container mt-4">
        <form method="post" action="{{ route('payer_code.update', $payer_code->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                    <label class="form-label">Client</label>
                    <select class="form-control" name="client_name">
                        <option value="" selected disabled>Select client</option>
                        @if(count($client) > 0)
                        @foreach($client as $value)
                        <option value="{{$value->id}}" <?php if ($value->id == $payer_code->client_id) echo 'selected="selected"'; ?>>{{$value->client_name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('client_name'))
                    <span class="text-danger text-left">{{ $errors->first('client_name') }}</span>
                    @endif
                </div>
            <div class="mb-3">
                <label for="payer_code" class="form-label">Payer code</label>
                <input value="{{ $payer_code->payer_code }}" type="number" class="form-control" name="payer_code" placeholder="Payer code" required>

                @if ($errors->has('payer_code'))
                <span class="text-danger text-left">{{ $errors->first('payer_code') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('payer_code.index') }}" class="btn btn-default">Cancel</button>
        </form>
    </div>

</div>
@endsection