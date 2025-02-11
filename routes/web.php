<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::resource('employees', EmployeeController::class);

Route::resource('attendances', AttendanceController::class);



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

