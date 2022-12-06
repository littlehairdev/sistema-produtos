@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Apagar perfil') }}</div>

                    <div class="card-body">
                        <h1 class="text text-danger">Você tem certeza que deseja apagar seu perfil?</h1>
                        <form action="{{ route('perfil.apagar') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-end gap-3">
                                <a class="btn btn-primary" href="{{ route('home') }}" role="button">Voltar ao início</a>
                                <button type="submit" class="btn btn-outline-danger">Apagar minha conta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
