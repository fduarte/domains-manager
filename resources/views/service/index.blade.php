@extends('layouts.main')

@section('title', 'Service')

@section('content')

    <div id="app" class="flex-center position-ref full-height">
        <a class="btn btn-primary pull-right mb-2" href="/service/create"><i class="fa fa-plus-circle"></i> Add Service</a>
        <div id="services-datatable"></div>
    </div>

@endsection

