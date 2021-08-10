@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>{{$produto->nome}}</h4>
        </div>

        <div class="row" style="width: 30%; margin-right: auto; margin-left: auto">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$produto->nome}}</td>
                </tr>
                <tr>
                    <th scope="row">Valor</th>
                    <td>{{\App\Http\Controllers\generalsController::numberBrazilianModel($produto->valor)}}</td>
                </tr>
                <tr>
                    <th scope="row">Data do Cadastro</th>
                    <td>{{\App\Http\Controllers\generalsController::dateBrazilian($produto->data_cadastro)}}</td>
                </tr>
                <tr>
                    <th scope="row">Categoria</th>
                    <td>{{$produto->categoria->nome}}</td>
                </tr>
                <tr>
                    <th scope="row">Imagem</th>
                    <td>
                        @if($produto->imagem != null)
                            <img src="/storage/{{$produto->imagem}}" width="30%" height="30%">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="/produtos/{{$produto->id}}/edit" class="btn btn-primary btn-block" style="color: white">Editar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection


