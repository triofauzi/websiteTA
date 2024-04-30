<?php

use App\Http\Controllers\EmployeePayrollController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeePayrollController::class)->prefix('payroll')->group(function () {
    Route::get('/employee-payroll', 'index')->name('employee-payroll.index');
    Route::get('/employee-payroll/create', 'create')->name('employee-payroll.create');
    Route::post('/employee-payroll', 'store')->name('employee-payroll.store');
    Route::get('/employee-payroll/{employeePayroll}/show', 'show')->name('employee-payroll.show');
    Route::get('/employee-payroll/{employeePayroll}/edit', 'edit')->name('employee-payroll.edit');
    Route::patch('/employee-payroll/{employeePayroll}', 'update')->name('employee-payroll.update');
    Route::delete('/employee-payroll/{employeePayroll}', 'destroy')->name('employee-payroll.destroy');
});