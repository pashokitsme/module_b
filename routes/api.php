<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth'], function () {

  Route::get('/auth/me', [AuthController::class, 'me']);

  Route::group(['middleware' => 'auth.admin'], function () {


    Route::prefix('/regions')->group(function () {
      Route::post('/', [RegionController::class, 'store']);

      Route::prefix('/{regionId}')->group(function () {
        Route::delete('/', [RegionController::class, 'delete']);
        Route::put('/', [RegionController::class, 'update']);

        Route::prefix('/organizations')->group(function () {
          Route::post('/', [OrganizationController::class, 'store']);

          Route::prefix('/{orgId}')->group(function () {
            Route::delete('/', [OrganizationController::class, 'delete']);
            Route::put('/', [OrganizationController::class, 'update']);
          });
        });
      });
    });
  });

  Route::get('/regions', [RegionController::class, 'all']);
  Route::get('/regions/{regionId}/organizations', [OrganizationController::class, 'all']);

  Route::get('/regions/{id}', [RegionController::class, 'exact']);
});