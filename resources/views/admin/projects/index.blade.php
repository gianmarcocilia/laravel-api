@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center py-3">Questi sono tutti i Progetti</h2>
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

        @if (count($projects) > 0)
            <table class="table table-striped my-5">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->created_at }}</td>
                            <td>
                                <a class="btn btn-success"
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}">Dettagli</a>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}">Modifica</a>
                                <form class="d-inline-block"
                                    action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning d-flex justify-content-between align-items-center">
                <h4 class="m-0">Non ci sono progetti!</h4>
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Crea un nuovo progetto</a>
            </div>
        @endif

        <div>
            {{ $projects->links() }}
        </div>
    </div>

@endsection
