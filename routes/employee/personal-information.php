<?php

use App\Http\Controllers\BiodataController;
use Illuminate\Support\Facades\Route;

Route::controller(BiodataController::class)->prefix('employee')->group(function () {
    Route::get('/personal-information', 'index')->name('personal-information.index');
    Route::get('/personal-information/create', 'create')->name('personal-information.create');
    Route::post('/personal-information', 'store')->name('personal-information.store');
    Route::get('/personal-information/{biodata}/show', 'show')->name('personal-information.show');
    Route::get('/personal-information/{biodata}/edit', 'edit')->name('personal-information.edit');
    Route::patch('/personal-information/{biodata}', 'update')->name('personal-information.update');
    Route::delete('/personal-information/{biodata}', 'destroy')->name('personal-information.destroy');
});