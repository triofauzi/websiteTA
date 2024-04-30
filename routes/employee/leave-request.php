<?php

use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;

Route::controller(LeaveRequestController::class)->prefix('employee')->group(function () {
    Route::get('/leave-request', 'index')->name('leave-request.index');
    Route::get('/leave-request/create', 'create')->name('leave-request.create');
    Route::post('/leave-request', 'store')->name('leave-request.store');
    Route::get('/leave-request/{leaveRequest}/show', 'show')->name('leave-request.show');
    Route::get('/leave-request/{leaveRequest}/edit', 'edit')->name('leave-request.edit');
    Route::patch('/leave-request/{leaveRequest}', 'update')->name('leave-request.update');
    Route::delete('/leave-request/{leaveRequest}', 'destroy')->name('leave-request.destroy');

    Route::patch('/leave-request/{leaveRequest}/approve', 'approveLeaveRequest')->name('leave-request.approve');
    Route::post('/leave-request/{user}/gen', 'generateLeaveLetter')->name('leave-request.generate');
});