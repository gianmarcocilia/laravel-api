@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h2 class="py-3">Queste sono le tipologie dei progetti</h2>
                @if (count($types) > 0)
                    <table class="table table-striped my-5">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <th scope="row">{{ $type->id }}</th>
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('admin.types.show', ['type' => $type->slug]) }}">Dettagli</a>
                                        <a class="btn btn-warning"
                                            href="{{ route('admin.types.edit', ['type' => $type->slug]) }}">Modifica</a>

                                        <form class="d-inline-block"
                                            action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}"
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
                    <div class="alert alert-warning">
                        <h4>Non ci sono tipologie!</h4>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <h2 class="py-3">Crea una nuova Tipologia</h2>
                <form class="my-5" action="{{ route('admin.types.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 py-2 has-validation">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success" type="submit">Salva</button>
                </form>
            </div>
        </div>
    </div>

@endsection
