<?php

use App\Http\Controllers\GenericController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//genericController
Route::get('comercial',[GenericController::class, 'comercial']);
Route::get('register',[GenericController::class, 'register']);

//UsuarioController
Route::post('usuario/relatorio', [UsuarioController::class , 'relatorio'])->name('usuario.relatorio');
Route::post('usuario/grafico_barra', [UsuarioController::class, 'grafico_barra'])->name('usuario.grafico_barra');
Route::post('usuario/grafico_pizza', [UsuarioController::class, 'grafico_pizza'])->name('usuario.grafico_pizza');

//ClienteController
Route::post('cliente/relatorio', [ClienteController::class, 'relatorio'])->name('cliente.relatorio');
Route::post('cliente/grafico_linha', [ClienteController::class, 'grafico_linha'])->name('cliente.grafico_linha');
Route::post('cliente/grafico_pizza', [ClienteController::class, 'grafico_pizza'])->name('cliente.grafico_pizza');

//HomeController
// Route::post('entrar', [HomeController::class, 'entrar'])->name('entrar'); 
// Route::post('registrar', [HomeController::class, 'registrar'])->name('registrar'); 
// Route::post('sair', [HomeController::class, 'sair'])->name('sair');


Route::get('home', [GenericController::class, 'home'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
