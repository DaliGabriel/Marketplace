<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;

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

//hacer el dashboard como la pagina por defecto al iniciar sesion
Route::get('/', function () {
    return redirect('dashboard');
});

//Mostrar formulario para agregar productos
Route::get('/agregar_productos', [ProductosController::class, 'agregar_productos'])->middleware(['auth', 'verified'])->name('agregar_productos');

//Descripcion del producto
Route::get('/producto/{productos}',[ProductosController::class, 'show'])->middleware(['auth', 'verified']);

//Mostrar formulario para editar productos
Route::get('/{productos}/edit',[ProductosController::class, 'edit'])->middleware(['auth', 'verified'])->name('editar_productos');

Route::get('/dashboard', [ProductosController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('productos', ProductosController::class)
    ->only(['index', 'store', 'edit','update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Compra del producto
Route::get('/checkout/{producto}',[ProductosController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');
Route::get('/exito',[ProductosController::class, 'exito'])->middleware(['auth', 'verified'])->name('exito');
Route::get('/fallo',[ProductosController::class, 'fallo'])->middleware(['auth', 'verified'])->name('fallo');

require __DIR__.'/auth.php';
