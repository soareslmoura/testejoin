<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::with(['categoria'])->paginate(20);
        $categorias = CategoriaProduto::all()->sortBy('nome');

        return view('produtos.index', compact('produtos', 'categorias'));
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
//        dd($request->file('imagem'));

        $regras = [
            'nome' => 'required|min:3|max:200',
            'valor' => 'required|min:1',
            'categoria_produto_id' => 'exists:categoria_produtos,id',
            'imagem' => 'mimes:jpg,jpeg,png'
        ];

        $feddback = [
            'required' => 'Favor, preencha o nome do produto.',
            'nome.min' => 'O nome do produto deve ter ao menos 3 letras.',
            'nome.max' => 'O nome do produto deve ter ao menos 3 letras.',
            'categoria_produto_id.exists' => 'Favor, escolha uma categoria válida.',
            'imagem.size' => 'A imgem deve ter até 5120kb.',
            'imagem.mimes' => 'A imgem deve ter extensão JPG, JPEG ou PNG.'
        ];

        $request->validate($regras, $feddback);

        if(isset($imagem)){
            $path = $imagem->store('imagens/produtos', 'public');
        }else{
            $path = null;
        }

        Produto::create([
            'nome' => mb_strtoupper($request->nome),
            'valor' => generalsController::numberWithoutPoints($request->valor),
            'data_cadastro' => Date('Y/m/d'),
            'categoria_produto_id' => $request->categoria_produto_id,
            'imagem' => $path
        ]);

        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::with(['categoria'])->where('id' , $id)->first();
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::with(['categoria'])->where('id' , $id)->first();
        $categorias = CategoriaProduto::all()->sortBy('nome');
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $regras = [
            'nome' => 'required|min:3|max:200',
            'valor' => 'required|min:1',
            'categoria_produto_id' => 'exists:categoria_produtos,id',
            'imagem' => 'mimes:jpg,jpeg,png'
        ];

        $feddback = [
            'required' => 'Favor, preencha o nome do produto.',
            'nome.min' => 'O nome do produto deve ter ao menos 3 letras.',
            'nome.max' => 'O nome do produto deve ter ao menos 3 letras.',
            'categoria_produto_id.exists' => 'Favor, escolha uma categoria válida.',
            'imagem.size' => 'A imgem deve ter até 5120kb.',
            'imagem.mimes' => 'A imgem deve ter extensão JPG, JPEG ou PNG.'
        ];

        $request->validate($regras, $feddback);

        if($produto->imagem != null){
            Storage::disk('public')->delete($produto->imagem);
        }

        $imagem = $request->file('imagem');
        if(isset($imagem)){
            $path = $imagem->store('imagens/produtos', 'public');
        }else{
            $path = null;
        }

        $produto->update([
            'nome' => $request->nome,
            'valor' => generalsController::numberWithoutPoints($request->valor),
            'categoria_produto_id' => $request->categoria_produto_id,
            'imagem' => $path
        ]);

        return redirect()->route('produtos.show',['produto'=>$produto->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $produto = Produto::where('id', $request->produtoDelete_id)->first();
        $produto->delete();

        return redirect()->route('produtos.index');
    }
}
