<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function minhaConta()
    {
        $usuarioLogado = Auth::user();
        return view('perfil.meu-perfil')->with('user', $usuarioLogado);
    }

    public function update(Request $request)
    {

        $usuarioLogado = Auth::user();
        $request->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($usuarioLogado->id, 'id')],
            'novaSenha' => ['nullable', 'min:8']
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.unique' => 'O email já existe.',
            'novaSenha.min' => 'A nova senha deve ter no mínimo 8 caracteres.'
        ]);

        $valido = $request->all();
        unset($valido['_token']);

        if (isset($valido['senhaAntiga']) || isset($valido['novaSenha']) || isset($valido['confirmarSenha'])) {
            if (!isset($valido['senhaAntiga'])) {
                return view('perfil.meu-perfil')->with('error', 'Senha antiga é obrigatória para atualizar a senha.')->with('user', $usuarioLogado);
            };
            if (!isset($valido['novaSenha'])) {
                return view('perfil.meu-perfil')->with('error', 'Nova senha é obrigatória para atualizar a senha.')->with('user', $usuarioLogado);
            };
            if (!isset($valido['confirmarSenha'])) {
                return view('perfil.meu-perfil')->with('error', 'A confirmação da é obrigatória para atualizar a senha.')->with('user', $usuarioLogado);
            };

            if ($valido['novaSenha'] !== $valido['confirmarSenha']) {
                return view('perfil.meu-perfil')->with('error', 'As nova senha e a confirmação não são iguais.')->with('user', $usuarioLogado);
            }

            if (!Hash::check($valido['senhaAntiga'], $usuarioLogado['password'])) {
                return view('perfil.meu-perfil')->with('error', 'A senha antiga está incorreta.')->with('user', $usuarioLogado);
            }

            $valido['password'] = Hash::make($valido['novaSenha']);
        }


        $usuarioLogado->fill($valido);

        $usuarioLogado->save();

        return view('perfil.meu-perfil')->with('user', $usuarioLogado)->with("msg", "Perfil atualizado com sucesso.");
    }

    public function listaUsuarios()
    {
        $usuarios = User::all();
        return view('usuarios.listar')->with('usuarios', $usuarios);
    }

    public function delete()
    {
        return view('perfil.apagar');
    }

    public function destroy()
    {
        $usuarioLogado = Auth::user();

        $usuarioLogado->destroy($usuarioLogado->id);

        Auth::logout();

        return redirect()->route('home');
    }
}