@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>Editar {{$categoria->nome}}</h4>
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
            <form method="post" action="{{route('categorias.update',['categoria' => $categoria->id])}}" style="width: 50%; margin-left: auto; margin-right: auto">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" class="form-control" id="nomeCategoria" value="{{old('nome')? old('nome') : $categoria->nome}}" required name="nome" placeholder="Nome do produto">
                </div>
                <div class="modal-footer">
                    <a href="{{route('categorias.index')}}" type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </section>
@endsection


