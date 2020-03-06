@extends('layouts.main')

@section('title', 'Client')

@section('content')

    <div id="app" class="flex-center position-ref full-height">
        <a class="btn btn-primary pull-right mb-2" href="/client/create"><i class="fa fa-plus-circle"></i> Add Client</a>
        <div id="clients-datatable"></div>
    </div>

@endsection

