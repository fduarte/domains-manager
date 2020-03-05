@extends('layouts.main')

@section('title', 'Edit Service')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Edit Service</h2>
        <hr />

        <form action="{{ route('service.update', $service->id) }}" method="POST">
            @csrf

            <input name="id" type="hidden" value="{{ $service->id }}" />

            <div class="form-group">
                <label for="service-name">Service Name</label>
                <input id="service-name" name="name" type="text" value="{{ old('name', $service->name) }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="service-price">Service Price</label>
                <input id="service-price" name="price" type="text" value="{{ old('price', $service->price) }}" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <span class="text-danger">{{ $errors->first('price') }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('service.index') }}">Cancel</a>
            <a class="btn alert-danger pull-right" href="{{ route('service.destroy', $service->id) }}">Delete</a>

        </form>
    </div>

@endsection

