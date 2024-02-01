@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                    </div>


                </div>
                <h2 class="py-3">Ciao {{ $user->name }}! Benvenuto nel tuo portfolio di progetti.</h2>
                @if ($user->email_verified_at)
                    <p>Complimenti hai verificato la tua mail: <strong>{{ $user->email }}</strong>.</p>
                @else
                <div class="alert alert-warning">
                    <p>La tua mail <strong>{{ $user->email }}</strong> non è ancora stata verificata.</p>
                </div>
                @endif
                <p>Hai scritto: {{  count($user->projects)  }} progetti.</p>
            </div>
        </div>
    </div>
@endsection
