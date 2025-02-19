<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->group(function () {
    Route::post('/create', [EmployeeController::class, 'create']);
    Route::patch('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);
    Route::get('/getById/{id}', [EmployeeController::class, 'getById']);
    Route::get('/getAll', [EmployeeController::class, 'getAll']);
    Route::get('/getByAddress/{address}', [EmployeeController::class, 'getByAddress']);
    Route::get('/test', [EmployeeController::class, 'test']);
});
