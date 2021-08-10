<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('categoria_produtos')->orderBy('nome')->paginate(15);

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'nome' => 'required|min:3'
        ];

        $feddback = [
            'required' => 'Favor, preencha o campo',
            'nome.min' => 'A categoria deve ter ao menos 3 letras'
        ];

        $request->validate($regras, $feddback);
        CategoriaProduto::create([
            'nome'=>mb_strtoupper($request->nome)
        ]);

        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  CategoriaProduto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaProduto $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CategoriaProduto $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaProduto $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CategoriaProduto $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaProduto $categoria)
    {

        $regras = [
            'nome' => 'required|min:3'
        ];

        $feddback = [
            'required' => 'Favor, preencha o campo',
            'nome.min' => 'A categoria deve ter ao menos 3 letras'
        ];

        $request->validate($regras, $feddback);

        $categoria->update([
            'nome'=> mb_strtoupper($request->nome),
        ]);

        return redirect()->route('categorias.show',['categoria'=>$categoria->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $categoria = CategoriaProduto::where('id', $request->categoriaDelete_id)->first();
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
