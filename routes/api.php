<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth'], function () {

  Route::get('/auth/me', [AuthController::class, 'me']);

  Route::group(['middleware' => 'auth.admin'], function () {

    Route::prefix('/categories')->group(function () {
      // Route::get()
    });


    Route::prefix('/regions')->group(function () {
      Route::post('/', [RegionController::class, 'store']);

      Route::prefix('/{regionId}')->group(function () {
        Route::delete('/', [RegionController::class, 'delete']);
        Route::put('/', [RegionController::class, 'update']);

        Route::prefix('/organizations')->group(function () {
          Route::post('/', [BranchController::class, 'store']);

          Route::prefix('/{branchId}')->group(function () {
            Route::delete('/', [BranchController::class, 'delete']);
            Route::put('/', [BranchController::class, 'update']);

            Route::prefix('/consultants')->group(function () {
              Route::get('/', [ConsultantController::class, 'all']);
              Route::post('/', [ConsultantController::class, 'store']);
            });
          });
        });
      });
    });
  });

  Route::get('/regions', [RegionController::class, 'all']);
  Route::get('/regions/{regionId}/organizations', [BranchController::class, 'all']);

  Route::get('/regions/{id}', [RegionController::class, 'exact']);
});