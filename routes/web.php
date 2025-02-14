<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');

Route::resource('employees', EmployeeController::class);

Route::resource('attendances', AttendanceController::class);

Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');

Route::get('/attendances/history/{employee_id}', [AttendanceController::class, 'history'])->name('attendances.history');

Route::get('/employees/{id}/download-pdf', [EmployeeController::class, 'downloadAttendancePDF'])->name('employees.download_pdf');

Route::get('/attendances/{employee_id}/download-pdf', [AttendanceController::class, 'downloadAttendancePDF'])->name('attendances.download_pdf');

Route::get('/attendances/{id}/checkout', [AttendanceController::class, 'checkOut'])->name('attendances.checkOut');

Route::put('/attendances/{id}', [AttendanceController::class, 'update'])->name('attendances.update');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

