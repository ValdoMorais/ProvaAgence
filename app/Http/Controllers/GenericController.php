<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class GenericController extends Controller
{
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
