@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Criar produto') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="criaProduto" action="{{ route('produtos.editar', $produto->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3 d-flex justify-content-center">
                                <img src="{{ url("storage/{$produto->foto}") }}" width="200" height="200">
                            </div>

                            <div class="mb-3">
                                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                <label for="foto" class="form-check-label">Foto</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                                    value="{{ $produto->nome }}">
                                <label for="nome">Nome</label>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" rows="3" form="criaProduto" placeholder="Digite uma descrição" id="descricao"
                                        name="descricao">{{ $produto->descricao }}</textarea>
                                    <label for="descricao">Descricão</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" name="preco" id="preco" placeholder="Preço" class="form-control"
                                    value="{{ $produto->preco }}">
                                <label for="preco">Preço</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
