<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/Usuarios',[UsuarioController::class,'obtener']);
Route::put('/Usuarios/{id}',[UsuarioController::class,'actualizar']);
Route::delete('/Usuarios/{id}',[UsuarioController::class,'eliminar']);
Route::post('/Usuarios',[UsuarioController::class,'crear']);

Route::get('/Categorias',[CategoriaController::class,'obtener']);
Route::put('/Categorias/{id}',[CategoriaController::class,'actualizar']);
Route::delete('/Categorias/{id}',[CategoriaController::class,'eliminar']);
Route::post('/Categorias',[CategoriaController::class,'crear']);

Route::get('/entradas',[EntradaController::class, 'index']);
Route::put('/entradas/{id}',[EntradaController::class,'actualizar']);
Route::delete('/entradas/{id}',[EntradaController::class,'eliminar']);
Route::post('/entradas',[EntradaController::class,'crear']);
