@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>Editar {{$produto->nome}}</h4>
        </div>
        @if(count($errors)!=0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row" style="width: 30%; margin-right: auto; margin-left: auto">
            <form method="post" enctype="multipart/form-data" action="{{route('produtos.update',['produto' => $produto->id])}}" style="width: 50%; margin-left: auto; margin-right: auto">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" class="form-control" id="nomeCategoria" value="{{old('nome')? old('nome') : $produto->nome}}" required name="nome" placeholder="Nome do produto">
                </div>
                <div>
                    <label for="valorProduto">Valor</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">R$</div>
                        </div>
                        <input type="text" class="form-control money" id="valorProduto" value="{{old('valor')? old('valor') : \App\Http\Controllers\generalsController::numberBrazilianModel($produto->valor)}}" required name="valor" placeholder="0,00">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Categoria</label>
                    <select class="form-control" id="catProduto" name="categoria_produto_id" required>
                        <option value="0" selected >Selecione a Categoria</option>
                        @foreach($categorias as $cat)
                            <option value="{{$cat->id}}" {{old('categoria_produto_id')==$cat->id? 'selected' :''}} {{$produto->categoria_produto_id==$cat->id? 'selected' :''}}>{{$cat->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="imgProduto">Foto</label>
                    <input type="file" class="form-control" id="imgProduto" name="imagem" >
                    @if($produto->imagem != null)
                        <img src="/storage/{{$produto->imagem}}" width="30%" height="30%">
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="{{route('produtos.index')}}" type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </section>
@endsection


