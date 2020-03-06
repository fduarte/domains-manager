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
                <input id="service-name" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="service-price">Service Price</label>
                <input id="service-price" name="price" type="text" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="text-danger">{{ $errors->first('price') }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('service.index') }}">Cancel</a>

        </form>
    </div>

@endsection

