@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Meu Perfil') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @isset($msg)
                            <div class="alert alert-success" role="alert">
                                {{ $msg }}
                            </div>
                        @endisset

                        @isset($error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endisset

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="editaPerfil" action="{{ route('perfil.editar') }}" method="POST">

                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="name" placeholder="Nome"
                                    value="{{ $user->name }}">
                                <label for="nome">Nome</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="email" placeholder="Nome"
                                    value="{{ $user->email }}">
                                <label for="nome">Email</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="nome" name="senhaAntiga"
                                    placeholder="Nome" />
                                <label for="nome">Senha antiga</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="nome" name="novaSenha"
                                    placeholder="Nome" />
                                <label for="nome">Nova senha</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="nome" name="confirmarSenha"
                                    placeholder="Nome" />
                                <label for="nome">Confirmar senha</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a class="btn btn-danger" href="{{ route('perfil.apagar.page') }}" role="button">Apagar minha
                                conta</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
