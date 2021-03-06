@extends('layouts.main')

@section('title', 'Domains')

@section('content')

    <div id="app" class="flex-center position-ref full-height">
        <a class="btn btn-primary pull-right mb-2" href="/domain/create"><i class="fa fa-plus-circle"></i> Add Domain</a>
        <div id="domains-datatable"></div>
    </div>

@endsection

