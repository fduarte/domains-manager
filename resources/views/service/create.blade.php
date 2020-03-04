@extends('layouts.main')

@section('title', 'Create Service')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Add a Service</h2>
        <hr />

        <form action="{{ route('service.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="service-name">Service Name</label>
                <input id="service-name" name="service_name" type="text" class="form-control @error('service_name') is-invalid @enderror">
                @error('service_name')
                <span class="text-danger">{{ $errors->first('service_name') }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('/') }}">Cancel</a>

        </form>
    </div>

@endsection

