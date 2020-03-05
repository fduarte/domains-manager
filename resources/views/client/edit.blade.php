@extends('layouts.main')

@section('title', 'Edit Client')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Edit Client</h2>
        <hr />

        <form action="{{ route('client.update', $client->id) }}" method="POST">
            @csrf

            <input name="id" type="hidden" value="{{ $client->id }}" />

            <div class="form-group">
                <label for="client-name">Client Name</label>
                <input id="client_name" name="name" value="{{ old('client_name', $client->name) }}" type="text" class="form-control @error('client_name') is-invalid @enderror">
                @error('client_name')
                <span class="text-danger">{{ $errors->first('client_name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="company_name">Company</label>
                <input id="company_name" name="company_name" value="{{ $client->company_name }}" type="text" class="form-control @error('company_name') is-invalid @enderror">
                @error('company_name')
                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" value="{{ $client->email }}" type="text" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" value="{{ $client->phone }}" type="text" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p class="mb-0">Services</p>
                @foreach ($services as $id => $name)
                    <div class="form-check">
                        <input
                            id="{{$id}}"
                            class="form-check-input"
                            type="checkbox"
                            name="services[]"
                            value="{{ $id }}"
                            aria-label="{{ $name }}"
                            {{ in_array($id, $clientServices) ? "checked" : "" }}
                        >
                        <label class="form-check-label" for="{{$id}}">{{ $name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('client.index') }}">Cancel</a>
            <a class="btn alert-danger pull-right" href="{{ route('client.destroy', $client->id) }}">Delete</a>

        </form>
    </div>

@endsection

