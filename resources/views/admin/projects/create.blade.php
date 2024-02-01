@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center py-3">Nuovo progetto</h2>
        <form class="mt-5" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 has-validation">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3 has-validation">
                <label for="project_image" class="form-label">Immagine del progetto</label>
                <input class="form-control @error('project_image') is-invalid @enderror" type="file" id="project_image"
                    name="project_image" enctype="multipart/form-data">
                @error('project_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 has-validation">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type">Seleziona tipologia</label>
                <select class="form-select" name="type_id" id="type">
                    <option @selected(!old('type_id')) value="">Nessuna tipologia</option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <p class="m-0">Tecnologie:</p>
            <div class="d-flex flex-row gap-3 pt-2 py-4">
                
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="{{ $technology->name }}" name="technologies[]" @checked(in_array($technology->id, old('technologies', [])))>
                        <label class="form-check-label" for="{{ $technology->name }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-success" type="submit">Salva</button>
        </form>
    </div>

@endsection
