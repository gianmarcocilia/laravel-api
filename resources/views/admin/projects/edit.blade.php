@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center py-3">Stai modificando il progetto: {{ $project->title }}</h2>
        <form class="mt-5" action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 has-validation">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 has-validation">
                <label for="project_image" class="form-label">Immagine del progetto</label>
                <input class="form-control @error('project_image') is-invalid @enderror" type="file" id="project_image"
                    name="project_image">
                @error('project_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 has-validation">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                    name="description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="pb-2" for="type">Seleziona tipologia</label>
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
                            id="{{ $technology->name }}" name="technologies[]" @checked($project->technologies->contains($technology))>
                        <label class="form-check-label" for="{{ $technology->name }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <a class="btn btn-danger" href="{{ route('admin.projects.index') }}">Annulla modifiche</a>
            <button class="btn btn-success" type="submit">Salva modifiche</button>
        </form>
    </div>
@endsection
