@extends('app')

@section('title', 'Domains')

@section('content')

    <h4 class="pull-left">Domains</h4>
    <a href="/domain/add" type="button" class="btn btn-sm btn-success pull-right" /><i class="fa fa-plus-circle"></i> Add New</a>
    <table class="table table-sm">
        <thread class="thread-light">
            <tr>
                <th>Client</th>
                <th>Domain</th>
                <th>Expires</th>
                <th>Actions</th>
            </tr>
        </thread>
        @foreach($domains as $domain)
            <tr>
                <td>
                    @isset($domain->client)
                        {{ $domain->client->name }}
                    @endisset
                </td>
                <td>{{ $domain->domain_name }} </td>
                <td>{{ $domain->domain_expires_date }} </td>
                <td>
                    <button type="button" class="whois btn btn-primary btn-sm"><i class="fa fa-refresh"></i></button>
                    <button type="button" class="email-reminder btn btn-success btn-sm"><i class="fa fa-envelope"></i></button>
                    <button type="button" class="domain-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>

@endsection