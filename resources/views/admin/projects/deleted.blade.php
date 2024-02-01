@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center py-3">Questi sono i Progetti eliminati</h2>

        @if (count($projects) > 0)
            <table class="table table-striped my-5">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data Eliminazione</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->deleted_at }}</td>
                            <td>
                                <form class="d-inline-block"
                                    action="{{ route('admin.projects.restore', ['id' => $project->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success" type="submit">Ripristina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-success d-flex">
                <h4 class="text-center">Il Cestino è vuoto!</h4>
            </div>
        @endif
    </div>
@endsection
