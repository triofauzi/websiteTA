<?php

use App\Http\Controllers\RetirementRequestController;
use Illuminate\Support\Facades\Route;

Route::controller(RetirementRequestController::class)->prefix('employee')->group(function () {
    Route::get('/retirement-request', 'index')->name('retirement-request.index');
    Route::get('/retirement-request/create', 'create')->name('retirement-request.create');
    Route::post('/retirement-request', 'store')->name('retirement-request.store');
    Route::get('/retirement-request/{retirementRequest}/show', 'show')->name('retirement-request.show');
    Route::get('/retirement-request/{retirementRequest}/edit', 'edit')->name('retirement-request.edit');
    Route::patch('/retirement-request/{retirementRequest}', 'update')->name('retirement-request.update');
    Route::delete('/retirement-request/{retirementRequest}', 'destroy')->name('retirement-request.destroy');

    Route::patch('/retirement-request/{retirementRequest}/approve', 'approveRetirementRequest')->name('retirement-request.approve');
    Route::get('/retirement-request/{retirementRequest}/download', 'downloadRetirementRequestLetter')->name('retirement-request.download');
    Route::get('/retirement-request/gen', 'retirementRequestPage')->name('retirement-request.generator');
    Route::post('/retirement-request/gen/exec', 'generateRetirementLetterPage')->name('retirement-request.generate');
});