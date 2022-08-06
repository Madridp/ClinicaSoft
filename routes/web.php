<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\LoteInsumoController;
use App\Http\Controllers\MedicoReferenteController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProcesoExamenController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\TipoCompraController;
use App\Http\Controllers\TipoExamenController;
use App\Http\Controllers\TipoInsumoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UsuarioController;
use App\Models\DeudaProveedor;

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

// Route::get('login', function(){
//     return view('auth.login');
// })->name('login');

Auth::routes([
    'register' => false, // Registration Routes...
    // 'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::resource('usuario', UsuarioController::class);
Route::resource('tecnico', TecnicoController::class);
Route::resource('proveedor', ProveedorController::class);
Route::resource('paciente', PacienteController::class);
Route::resource('medicoReferente', MedicoReferenteController::class);
Route::resource('loteInsumo', LoteInsumoController::class);
Route::resource('insumo', InsumoController::class);
Route::resource('tipoInsumo', TipoInsumoController::class);
Route::resource('tipoCompra', TipoCompraController::class);
Route::resource('tipoExamen', TipoExamenController::class);
Route::resource('procesoExamen', ProcesoExamenController::class);
Route::get('compra/bitacora', [CompraController::class, 'bitacora']);
Route::resource('compra', CompraController::class);
Route::resource('deudaProveedor', DeudaProveedor::class);
Route::get('examen/bitacora', [ExamenController::class, 'bitacora'])->name('examen.bitacora');
Route::resource('examen', ExamenController::class);

Route::get('admin', [HomeController::class, 'index'])->name('admin');
