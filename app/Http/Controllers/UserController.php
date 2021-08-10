<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request;

        $pass = Hash::make($request->pass);

        User::create([
            'name' => mb_strtoupper($request->nome),
            'email' => mb_strtolower($request->email),
            'password' =>$pass,
        ]);
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkLogin(Request $request)
    {
        $regras = [
            'login' => 'required|max:200',
            'pass' => 'required|min:1',

        ];

        $feddback = [
            'login.required' => 'Digite seu login.',
            'login.max' => 'Login muito extenso.',
            'pass.required' => 'Digite sua senha.',
        ];
        $request->validate($regras, $feddback);

        $user = Usuario::where('login', $request->login)->first();

        $errors = 'Login ou senha inválidos';
        if(!isset($user)) {
            $msgcreate = 'Usuário ou senha inválidos.';
            $typealert = 'danger';
            $icon = 'fa-times';
            return redirect()->back()->with(['msgcreate' => $msgcreate,'typealert' => $typealert, 'icon'=>$icon]);
        }
        if(!Hash::check($request->pass,$user->password)){
            $msgcreate = 'Usuário ou senha inválidos.';
            $typealert = 'danger';
            $icon = 'fa-times';
            return redirect()->back()->with(['msgcreate' => $msgcreate,'typealert' => $typealert, 'icon'=>$icon]);
        }

        Session::put('idUser', $user->id);
        Session::put('nome', $user->nome);
        Session::put('email', $user->email);
        return redirect()->route('produtos.index');
    }

    public function sair()
    {
        Session::flush();

        return redirect()->route('login');
    }
}
