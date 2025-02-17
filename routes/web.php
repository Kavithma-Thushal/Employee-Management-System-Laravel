<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('/create', [EmployeeController::class, 'create']);
Route::patch('/update/{id}', [EmployeeController::class, 'update']);
Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);
Route::get('/getById', [EmployeeController::class, 'getById']);
Route::get('/getAll', [EmployeeController::class, 'getAll']);
