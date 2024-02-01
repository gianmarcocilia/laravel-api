@extends('layouts.admin')

@section('content')
    <h2 class="py-3">Modifica una la Tipologia: {{$type->name}}</h2>
    <form class="my-5" action="{{ route('admin.types.update', ['type' => $type->slug]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3 py-2 has-validation">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $type->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success" type="submit">Salva</button>
    </form>
@endsection
