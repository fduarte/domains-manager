@extends('layouts.main')

@section('title', 'Edit Domain')

@section('content')

    <div class="flex-center position-ref full-height col-8" >

        <h2>Edit Domain</h2>
        <hr />

        <form action="{{ route('domain.update', $domain->id) }}" method="POST">
            @csrf

            <input name="id" type="hidden" value="{{ $domain->id }}" />

            <div class="form-group">
                <label for="domain-name">Domain Name</label>
                <input id="domain-name" name="domain_name" value="{{ $domain->domain_name }}" type="text" readonly class="form-control @error('domain_name') is-invalid @enderror">
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

            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('domain.index') }}">Cancel</a>

        </form>
    </div>

@endsection

