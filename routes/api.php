<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::prefix('employee')->group(function () {
            Route::post('', [EmployeeController::class, 'create']);
            Route::patch('{id}', [EmployeeController::class, 'update']);
            Route::delete('{id}', [EmployeeController::class, 'delete']);
            Route::get('/getById/{id}', [EmployeeController::class, 'getById']);
            Route::get('/getAll', [EmployeeController::class, 'getAll']);
            Route::get('/getByAddress/{address}', [EmployeeController::class, 'getByAddress']);
            Route::get('/getByEmail/{email}', [EmployeeController::class, 'getByEmail']);
            Route::get('/test', [EmployeeController::class, 'test']);
        });

        Route::prefix('staff')->group(function () {
            Route::post('', [StaffController::class, 'create']);
            Route::get('{id}', [StaffController::class, 'getById']);
        });
    });
});
