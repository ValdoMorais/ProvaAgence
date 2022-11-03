<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class GenericController extends Controller
{
    //Teste
    // public function welcome(){

    //     $usuario = Usuario::orderby('co_usuario', 'desc')->paginate(5);
        
    //     //testar pelo Postman
    //     //return response()->json(['Success' => $usuario], status: 200);

    //     //pela web
    //     dd();
    //     return view('welcome');
    // }



    public function comercial(){
        $usuarios = new Usuario();
        $usuarios = $usuarios->listarUsuarios();

        $clientes = new Cliente();
        $clientes = $clientes->listarClientes();

        return view('comercial', ['usuarios' => $usuarios, 'clientes' => $clientes]);
    }
    public function register(){
        return view('auth.register');
    }

    public function home(){
        return view('home');
    }
}
