@extends('layouts.appLayout')

@section('conteudo')
    <section style="padding-left: 10px; padding-right: 10px">
        <div style="background-color: #007bff; color: white; text-align: center; height: 35px; margin-bottom: 10px">
            <h4>{{$categoria->nome}}</h4>
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
                    <td>{{$categoria->nome}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{route('categorias.edit',['categoria'=> $categoria->id])}}" class="btn btn-primary btn-block" style="color: white">Editar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection


