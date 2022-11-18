@extends('layouts.app-master')
<title>Payer code</title>
@section('content')
    <div class="bg-light p-4 rounded">
        <h3></h1>Payer center</h3>
        <div class="container mt-4">
            <div>
                Payer code: {{ $payer_code->payer_code }}
            </div>
            <div>
                Payer code: {{ $payer_code->client_name }}
            </div>
        </div>

    </div>
    <div class="mt-4">
    <a href="{{ route('payer_code.edit', $payer_code->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('payer_code.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
