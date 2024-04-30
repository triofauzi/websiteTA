<?php

use App\Http\Controllers\JobPositionController;
use Illuminate\Support\Facades\Route;

Route::controller(JobPositionController::class)->prefix('managememnt')->group(function () {
    Route::get('/career-transition', 'careerTransitionSite')->name('job-position.career-transition');
    Route::post('/career-transition/{user}/promote', 'promoteEmployee')->name('job-position.promote');
});