<?php

use App\Http\Controllers\CareerTransitionHistoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CareerTransitionHistoryController::class)->prefix('career')->group(function () {
    Route::get('/career-transition-history', 'index')->name('career-transition-history.index');
    Route::get('/career-transition-history/create', 'create')->name('career-transition-history.create');
    Route::post('/career-transition-history', 'store')->name('career-transition-history.store');
    Route::get('/career-transition-history/{careerTransitionHistory}/show', 'show')->name('career-transition-history.show');
    Route::get('/career-transition-history/{careerTransitionHistory}/edit', 'edit')->name('career-transition-history.edit');
    Route::patch('/career-transition-history/{careerTransitionHistory}', 'update')->name('career-transition-history.update');
    Route::delete('/career-transition-history/{careerTransitionHistory}', 'destroy')->name('career-transition-history.destroy');

    Route::get('/career-transition-history/{careerTransitionHistory}/download-letter', 'downloadLetter')->name('career-transition-history.download-letter');
});