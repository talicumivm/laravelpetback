<?php

use App\Http\Controllers\DatesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::group(['prefix' => 'users'], function(){
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'new']);
    Route::get('/{id}', [UsersController::class, 'view']);
    Route::put('/{id}', [UsersController::class, 'edit']);

});

Route::group(['prefix' => 'mascotas'], function(){
    Route::get('/', [PetsController::class, 'index']);
    Route::post('/', [PetsController::class, 'new']);
    Route::get('/{id}', [PetsController::class, 'view']);
    Route::put('/{id}', [PetsController::class, 'edit']);
    Route::delete('/{id}', [PetsController::class, 'delete']);
});

Route::group(['prefix' => 'servicios'], function(){
    Route::get('/', [ServicesController::class, 'index']);
    Route::post('/', [ServicesController::class, 'new']);
});

Route::group(['prefix' => 'citas'], function(){
    Route::get('/', [DatesController::class, 'index']);
    Route::post('/', [DatesController::class, 'new']);
    Route::get('/{id}', [DatesController::class, 'view']);
    Route::put('/{id}',[DatesController::class, 'edit']);
    Route::delete('/{id}', [DatesController::class, 'delete']);
    Route::get('/{id}/user', [DatesController::class, 'getPerUser']);
});

Route::group(['prefix' => 'pagos'], function(){
    Route::get('/', [PaymentsController::class, 'index']);
    Route::post('/', [PaymentsController::class, 'new']);
});
## routa para ver la conexion con back and front 
Route::get('/test', function () {
    return response()->json(['message' => 'Conexión exitosa'], 200);
});
## routa para registro


Route::post('/register', [AuthController::class, 'register']);

