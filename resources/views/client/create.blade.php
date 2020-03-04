@extends('layouts.main')

@section('title', 'Create Client')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Add a Domain</h2>
        <hr />

        <form action="{{ route('client.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="client-name">Client Name</label>
                <input id="client-name" name="client_name" type="text" class="form-control @error('client_name') is-invalid @enderror">
                @error('client_name')
                <span class="text-danger">{{ $errors->first('client_name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="company-name">Company Name</label>
                <input id="company-name" name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror">
                @error('company_name')
                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p class="mb-0">Services</p>
                @foreach ($services as $id => $name)
                    <div class="form-check">
                        <input id="{{$id}}" class="form-check-input" type="checkbox" name="services[]" value="{{ $id }}" aria-label="{{ $name }}">
                        <label class="form-check-label" for="{{$id}}">{{ $name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('client.index') }}">Cancel</a>
            <a class="btn btn-alert pull-right" href="{{ route('client.index') }}">Delete</a>

        </form>
    </div>

@endsection

