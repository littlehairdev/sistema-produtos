@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Produtos') }}</div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                @forelse ($usuarios as $key => $usuario)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <th>{{ $usuario->name }}</th>
                                        <th>{{ $usuario->email }}</th>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6" class="alert alert-danger text-center">
                                            Nenhum usuário cadastrado!
                                        </th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
