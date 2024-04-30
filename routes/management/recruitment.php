<?php

use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::controller(JobApplicationController::class)->prefix('management')->group(function () {
    Route::get('/job-application', 'index')->name('job-application.index');
    Route::get('/job-application/create', 'create')->name('job-application.create');
    Route::get('/job-application/{jobApplication}/show', 'show')->name('job-application.show');
    Route::get('/job-application/{jobApplication}/edit', 'edit')->name('job-application.edit');
    Route::patch('/job-application/{jobApplication}', 'update')->name('job-application.update');
    Route::delete('/job-application/{jobApplication}', 'destroy')->name('job-application.destroy');

    Route::get('/job-application/{jobApplication}/download-cv', 'downloadCV')->name('job-application.download-cv');
    Route::get('/job-application/{jobApplication}/register-employee', 'registerEmployee')->name('job-application.register-employee');
});