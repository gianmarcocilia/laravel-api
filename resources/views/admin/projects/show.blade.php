@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center py-3">Questo è il progetto: {{ $project->title }}</h2>
        @if ($project->project_image)
            <div class="m-auto py-3">
                <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}">
            </div>
        @else
            <h5 class="text-center py-3">Nessuna immagine presente</h5>
        @endif
        <p class="text-center py-1">{{ $project->description }}</p>
        <p>Tipologia del progetto: <strong>{{ $project->type ? $project->type->name : 'Tipologia non definita' }}</strong>.
        </p>
        <p>Tecnologie del progetto:
            @if (count($project->technologies) > 0)
            
                @foreach ($project->technologies as $key => $technology)
                    <strong>{{ $technology->name }}</strong>@if (count($project->technologies) == $key + 1).
                    @else,
                    @endif

                @endforeach
            @else
                <strong>Tecnologie non definite.</strong>
            @endif
        </p>
        <p>Creato il <strong>{{ $project->created_at }}</strong></p>
        <div class="d-flex justify-content-between align-items-center">
            <p class="m-0">Ultima modifica il <strong>{{ $project->updated_at }}</strong></p>
            <div class="d-flex gap-3">
                <a class="btn btn-warning"
                    href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}">Modifica</a>
                <form class="d-inline-block" action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Elimina</button>
                </form>
            </div>
        </div>
    </div>
@endsection
