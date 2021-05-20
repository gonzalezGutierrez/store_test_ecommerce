<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1'],function(){

    Route::post('auth/login',[\App\Http\Controllers\API\Auth\AuthController::class,'login']);
    Route::post('auth/register',[\App\Http\Controllers\API\Auth\AuthController::class,'register']);

    Route::group(['middleware' => ['auth:api']], function(){
        Route::post('auth/logout',[\App\Http\Controllers\API\Auth\AuthController::class,'logout']);
        Route::get('users/profile',[\App\Http\Controllers\API\Users\UserController::class,'profile']);
    });

    Route::group(['middleware'=>['auth:api','userIsAdmin']],function(){
        Route::get('users',[\App\Http\Controllers\API\Users\UserController::class,'index'])->name('users.index');
        Route::get('users/{user}',[\App\Http\Controllers\API\Users\UserController::class,'show'])->name('users.show');
        Route::put('users/{user}',[\App\Http\Controllers\API\Users\UserController::class,'update'])->name('users.update');
        Route::delete('users/{user}',[\App\Http\Controllers\API\Users\UserController::class,'destroy'])->name('users.destroy');
    });

    Route::group(['middleware'=>['auth:api','userIsAdmin']],function(){
        Route::post('products',[\App\Http\Controllers\API\Products\ProductController::class,'store']);
        Route::put('products/{product}',[\App\Http\Controllers\API\Products\ProductController::class,'update']);
        Route::delete('products/{product}',[\App\Http\Controllers\API\Products\ProductController::class,'destroy']);
    });

    Route::get('products',[\App\Http\Controllers\API\Products\ProductController::class,'index']);
    Route::get('products/search/{filter?}',[\App\Http\Controllers\API\Products\ProductController::class,'search']);
    Route::get('products/sort/{sort?}',[\App\Http\Controllers\API\Products\ProductController::class,'sort']);
    Route::get('products/{product}/{slug}',[\App\Http\Controllers\API\Products\ProductController::class,'show']);


});
