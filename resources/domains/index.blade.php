@extends('app')

@section('title', '')

@section('content')

    <h4>Domains</h4>
    <ul>
        @foreach($domains as $domain)
            <li>{{ $domain->name . ' ' . $domain->expiration_date }}</li>
        @endforeach
    </ul>

@endsection