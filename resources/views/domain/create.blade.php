@extends('layouts.main')

@section('title', 'Create Domain')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Add a Domain</h2>
        <hr />

        <form action="{{ route('domain.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="domain-name">Domain Name</label>
                <input id="domain-name" name="domain_name" type="text" class="form-control @error('domain_name') is-invalid @enderror">
                @error('domain_name')
                    <span class="text-danger">{{ $errors->first('domain_name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="client-id">Assign a Client</label>
                <select class="form-control" name="client_id">
                    @foreach ($clients as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
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
            <a class="btn btn-secondary" href="{{ route('domain.index') }}">Cancel</a>

        </form>
    </div>

@endsection

