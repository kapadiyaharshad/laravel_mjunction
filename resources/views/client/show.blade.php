@extends('layouts.app-master')
<title>Client</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h1>Show Client</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">
        <div>
            <b>Client Name<:</b> {{ $client->clientname }} <br>
            <b>Email:</b> {{ $client->clientname }} <br>
            <b>Payer Code:</b> {{ $client->clientname }} <br>
            <b>Account Type:</b> {{ $client->clientname }} <br>
            <b>Business Segment:</b> {{ $client->clientname }} <br>
            <b>Business Unit:</b> {{ $client->clientname }} <br>
            <b>Services:</b> {{ $client->clientname }} <br>
            <b>Category:</b> {{ $client->clientname }} <br>
            <b>Profit Center:</b> {{ $client->clientname }}
        </div>
    </div>

</div>
<div class="mt-4">
    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('client.index') }}" class="btn btn-default">Back</a>
</div>
@endsection