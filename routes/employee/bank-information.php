<?php

use App\Http\Controllers\EmployeeBankController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeeBankController::class)->prefix('employee')->group(function () {
    Route::get('/employee-bank', 'index')->name('employee-bank.index');
    Route::get('/employee-bank/create', 'create')->name('employee-bank.create');
    Route::post('/employee-bank', 'store')->name('employee-bank.store');
    Route::get('/employee-bank/{employeeBank}/show', 'show')->name('employee-bank.show');
    Route::get('/employee-bank/{employeeBank}/edit', 'edit')->name('employee-bank.edit');
    Route::patch('/employee-bank/{employeeBank}', 'update')->name('employee-bank.update');
    Route::delete('/employee-bank/{employeeBank}', 'destroy')->name('employee-bank.destroy');
});