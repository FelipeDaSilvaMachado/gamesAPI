<?php

use App\Http\Controllers\JogosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rotas para visualizar os registros
Route::get('/',function (){return response()->json(['Sucesso'=>true]);});
Route::get('/jogos',[JogosController::class,'index']);
Route::get('/jogos/{id}',[JogosController::class,'show']);

//Rota para inserir os registros
Route::post('/jogos',[JogosController::class,'store']);

//Rota para alterar os registros
Route::put('/jogos/{id}',[JogosController::class,'update']);

//Rota para excluir o registro por id/codigo
Route::delete('/jogos/{id}',[JogosController::class,'destroy']);
