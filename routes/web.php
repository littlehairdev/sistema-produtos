<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

/* Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Produtos
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.lista.page');
Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('produtos.criar.page');
Route::post('/produtos/criar', [ProdutoController::class, 'store'])->name('produtos.criar');
Route::get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('produtos.editar.page');
Route::post('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('produtos.editar');
Route::get('/produtos/excluir/{id}', [ProdutoController::class, 'destroy'])->name('produtos.excluir');

// Usuário
Route::get('/meu-perfil', [UserController::class, 'minhaConta'])->name('perfil.page');
Route::post('/meu-perfil', [UserController::class, 'update'])->name('perfil.editar');
Route::get('/meu-perfil/deletar', [UserController::class, 'delete'])->name('perfil.apagar.page');
Route::post('/meu-perfil/deletar', [UserController::class, 'destroy'])->name('perfil.apagar');

// Lista de usuários
Route::get('/usuarios', [UserController::class, 'listaUsuarios'])->name('usuarios.lista.page');