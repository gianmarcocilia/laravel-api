@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Tipologia: {{ $type->name }}</h2>
        <p>Slug: {{ $type->slug }}</p>

        <hr>
        @if (count($type->projects) > 0)
            <h3>Tutti i progetti di questa tipologia</h3>
            <ul>
                @foreach ($type->projects as $project)
                    <li>
                        <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">{{ $project->title }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Nessun progetto presente per questa tipologia</p>            
        @endif
       
    </div>
@endsection