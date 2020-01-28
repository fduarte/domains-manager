@extends('app')

@section('title', 'Domains')

@section('content')

    <h4>Domains</h4>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Expires</th>
            <th>Refresh</th>
        </tr>
        @foreach($domains as $domain)
            <tr>
                <td>{{ $domain->domain_name }} </td>
                <td>{{ $domain->domain_expires_date }} </td>
                <td><button type="button" class="whois btn btn-primary btn-sm"><i class="fa fa-refresh"></i> WHOIS</button> </td>
            </tr>
        @endforeach
    </table>


@endsection