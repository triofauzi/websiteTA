<?php

use App\Http\Controllers\JobPositionController;
use Illuminate\Support\Facades\Route;

Route::controller(JobPositionController::class)->prefix('master-data')->group(function () {
    Route::get('/job-position', 'index')->name('job-position.index');
    Route::get('/job-position/create', 'create')->name('job-position.create');
    Route::post('/job-position', 'store')->name('job-position.store');
    Route::get('/job-position/{jobPosition}/show', 'show')->name('job-position.show');
    Route::get('/job-position/{jobPosition}/edit', 'edit')->name('job-position.edit');
    Route::patch('/job-position/{jobPosition}', 'update')->name('job-position.update');
    Route::delete('/job-position/{jobPosition}', 'destroy')->name('job-position.destroy');
});