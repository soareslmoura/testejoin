@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>Categorias</h4>
        </div>
        @if(count($errors)!=0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$errors->has('nome')?$errors->first():''}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novaCategoria" style="margin-bottom: 5px">
           Nova Categoria
        </button>
        <div class="row">
            <table class="table table-striped" style="margin-left: 10px; margin-right: 10px">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoria</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categorias as $cat)
                    <tr>
                        <th scope="row">{{$cat->id}}</th>
                        <td>{{$cat->nome}}</td>
                        <td>
                            <a href="/categorias/{{$cat->id}}" class="btn btn-success " title="Visualizar"><i class="fas fa-search"></i></a>
                            <a href="{{route('categorias.edit', ['categoria'=>$cat->id])}}" class="btn btn-primary" title="Editar"><i class="fas fa-edit"></i></a>
                            <button onclick="excluirCategoria({{$cat->id}})" class="btn btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    {{ $categorias->onEachSide(5)->links() }}
@endsection


<!-- Modal Nova Categoria -->
<div class="modal fade" id="novaCategoria" tabindex="-1" role="dialog" aria-labelledby="novaCategoria" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white">
                <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>

            </div>
            <div class="modal-body">
                <form method="post" action="categorias">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Categoria</label>
                        <input type="text" class="form-control" id="nomeCategoria" required  name="nome" placeholder="Nome da categoria">

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
