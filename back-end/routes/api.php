<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('brands', BrandController::class);


Route::apiResource('categories', CategoryController::class);


Route::apiResource('status', StatusController::class);


Route::apiResource('models', VehicleModelController::class);


Route::apiResource('vehicles', VehicleController::class);

Route::apiResource('colors', ColorController::class);
