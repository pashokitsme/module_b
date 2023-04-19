<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth'], function () {

  Route::group(['middleware' => 'auth.admin'], function () {
    Route::post('/regions', [RegionController::class, 'store']);
    Route::delete('/regions/{region}', [RegionController::class, 'delete']);
    Route::put('/regions/{region}', [RegionController::class, 'update']);
  });

  Route::get('/regions', [RegionController::class, 'all']);
  Route::get('/regions/{region}', [RegionController::class, 'exact']);
});
