<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UsuarioController;

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
    if ( Auth::user() ){
        return redirect()->route('admin');
    }

    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('usuario', UsuarioController::class);
Route::resource('tecnico', TecnicoController::class);
Route::resource('proveedor', ProveedorController::class);
Route::resource('paciente', PacienteController::class);
Route::resource('medicoReferente', MedicoReferenteController::class);
Route::resource('loteInsumo', LoteInsumoController::class);
Route::resource('insumo', InsumoController::class);
Route::resource('examen', ExamenController::class);