<?php

use App\Http\Controllers\PayrollPeriodController;
use Illuminate\Support\Facades\Route;

Route::controller(PayrollPeriodController::class)->group(function () {
    Route::get('/payroll-period', 'index')->name('payroll-period.index');
    Route::get('/payroll-period/create', 'create')->name('payroll-period.create');
    Route::post('/payroll-period', 'store')->name('payroll-period.store');
    Route::get('/payroll-period/{payrollPeriod}/show', 'show')->name('payroll-period.show');
    Route::get('/payroll-period/{payrollPeriod}/edit', 'edit')->name('payroll-period.edit');
    Route::patch('/payroll-period/{payrollPeriod}', 'update')->name('payroll-period.update');
    Route::delete('/payroll-period/{payrollPeriod}', 'destroy')->name('payroll-period.destroy');
    
    Route::post('/payroll-period/payment-process', 'paymentProcess')->name('payroll-period.payment-process');
});