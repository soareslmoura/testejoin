@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>Produtos</h4>
        </div>
        @if(count($errors)!=0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$errors->first()}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novaCategoria" style="margin-bottom: 5px">
            Novo Produto
        </button>
        <div class="row">
            <table class="table table-striped" style="margin-left: 10px; margin-right: 10px">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Imagem</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <td>

                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach($produtos as $prod)
                    <tr>
                        <th scope="row">{{$prod->id}}</th>
                        <td>{{$prod->nome}}</td>
                        <td>{{$prod->categoria->nome}}</td>
                        <td>
                            @if($prod->imagem != null)
                                <span class="badge badge-success">Sim</span>
                            @else
                                <span class="badge badge-danger">Não</span>
                            @endif
                        </td>
                        <td>{{\App\Http\Controllers\generalsController::numberBrazilianModel($prod->valor)}}</td>
                        <td>{{\App\Http\Controllers\generalsController::dateBrazilian($prod->data_cadastro)}}</td>
                        <td>
                            <a href="/produtos/{{$prod->id}}" class="btn btn-success " title="Visualizar"><i class="fas fa-search"></i></a>
                            <a href="/produtos/{{$prod->id}}/edit" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i></a>
                            <button  class="btn btn-danger" title="Excluir"><i class="fas fa-trash" onclick="excluirProduto({{$prod->id}})"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection


<!-- Modal Nova Categoria -->
<div class="modal fade" id="novaCategoria" tabindex="-1" role="dialog" aria-labelledby="novaCategoria" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white">
                <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="produtos" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nomeProduto">Nome</label>
                        <input type="text" class="form-control" id="nomeProduto" value="{{old('nome')}}" required name="nome" placeholder="Nome do produto">
                    </div>
                    <div>
                        <label for="valorProduto">Valor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="text" class="form-control money" id="valorProduto" value="{{old('valor')}}" required name="valor" placeholder="0,00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catProduto">Categoria</label>
                        <select class="form-control" id="catProduto" name="categoria_produto_id" required>
                            <option value="0" selected >Selecione a Categoria</option>
                            @foreach($categorias as $cat)
                                <option value="{{$cat->id}}" {{old('categoria_produto_id')==$cat->id? 'selected' :''}}>{{$cat->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imgProduto">Foto</label>
                        <input type="file" class="form-control" id="imgProduto" value="{{old('nome')}}" name="imagem" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
