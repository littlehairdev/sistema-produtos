<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.listar', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.criar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'unique:produtos'],
            'descricao' => ['required'],
            'preco' => ['required', 'numeric'],
            'foto' => ['required']
        ], [
            'nome.unique' => 'O produto já está cadastrado.',
            'descricao.required' => 'A descrição é obrigatória',
            'preco.required' => 'O preço é obrigatório.',
            'foto.required' => 'A foto do produto é obrigatória.'
        ]);

        $valid = $request->all();

        $foto = $request->file('foto');

        if (isset($foto)) {
            $dir = $request->foto->storeAs('/public', 'public.jpg');
            
        }

        $valid['foto'] = $dir;

        $valid['_token'] = null;

        Produto::create($valid);

        return redirect()->route('produtos.lista.page')->with('msg', 'Produto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        return view('produtos.editar')->with('produto', $produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produtos.editar')->with('produto', $produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => ['required'],
            'descricao' => ['required'],
            'preco' => ['required', 'numeric'],
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória',
            'preco.required' => 'O preço é obrigatório.',
        ]);

        $valid = $request->all();

        $foto = $request->file('foto');

        if (isset($foto)) {
            $dir = $request->foto->store('/', 'public');

            $valid['foto'] = $dir;
        } else {
            unset($valid['foto']);
        }

        unset($valid['_token']);


        $oldProduct = Produto::find($id);

        $oldProduct->fill($valid);

        $oldProduct->save();


        $produtos = Produto::all();
        return view('produtos.listar', ['produtos' => $produtos])->with('msg', 'Produto editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::destroy($id);

        $produtos = Produto::all();

        return view('produtos.listar', ['produtos' => $produtos])->with('msg', 'Produto excluído com sucesso.');
    }
}