<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::get("/user",function(Request $request){
        return $request->user();
    });

    Route::post("/logout",[AuthController::class,"logout"]);
    //almacenar ordenes

    Route::apiResource("/pedidos",PedidoController::class);

    Route::get("/categorias",[CategoriaController::class,"index"]);

    Route::apiResource("/productos",ProductoController::class);

});



//autenticacion

Route::post("/registro",[AuthController::class,"register"]);

Route::post("/login",[AuthController::class,"login"]);
