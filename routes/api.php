<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'users'], function(){
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'new']);
    Route::get('/{id}', [UsersController::class, 'view']);
    Route::put('/{id}', [UsersController::class, 'edit']);

});


