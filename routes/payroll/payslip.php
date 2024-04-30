<?php

use App\Http\Controllers\PaySlipController;
use Illuminate\Support\Facades\Route;

Route::controller(PaySlipController::class)->prefix('payroll')->group(function () {
    Route::get('/pay-slip', 'index')->name('pay-slip.index');
    Route::get('/pay-slip/create', 'create')->name('pay-slip.create');
    Route::post('/pay-slip', 'store')->name('pay-slip.store');
    Route::get('/pay-slip/{paySlip}/show', 'show')->name('pay-slip.show');
    Route::get('/pay-slip/{paySlip}/edit', 'edit')->name('pay-slip.edit');
    Route::patch('/pay-slip/{paySlip}', 'update')->name('pay-slip.update');
    Route::delete('/pay-slip/{paySlip}', 'destroy')->name('pay-slip.destroy');

    // generate pay slip
    Route::get('/pay-slip/{paySlip}/download', 'downloadPayslip')->name('pay-slip.download');
    Route::get('/pay-slip/gen', 'generatorPage')->name('pay-slip.generator');
    Route::post('/pay-slip/gen/exec', 'generatePaySlip')->name('pay-slip.generate');
});