@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Produtos') }}</div>

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

                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Foto</th>
                                <th>Ações</th>
                            </thead>
                            <tbody>
                                @forelse ($produtos as $key => $produto)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <th>{{ $produto->nome }}</th>
                                        <th>{{ $produto->descricao }}</th>
                                        <th>R$ {{ $produto->preco }}</th>
                                        <th>
                                            <img src="{{ url("storage/{$produto->foto}") }}" width="180" height="180"
                                                alt="">
                                        </th>
                                        <th>
                                            <div class="d-flex gap-3">
                                                <a class="btn btn-primary"
                                                    href="{{ route('produtos.editar.page', $produto->id) }}"
                                                    role="button">Editar</a>
                                                <a class="btn btn-danger"
                                                    href="{{ route('produtos.excluir', $produto->id) }}"
                                                    role="button">Excluir</a>
                                            </div>
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6" class="alert alert-danger text-center">
                                            Nenhum produto cadastrado!
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary" href="{{ route('produtos.criar.page') }}"
                                role="button">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
