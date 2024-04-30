<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::controller(SiteController::class)->group(function () {
    Route::get('/application-form', 'applicationForm')->name('site.applicant-form');
});

Route::controller(JobApplicationController::class)->group(function () {
    Route::post('/job-application', 'store')->name('job-application.store');
});

Route::middleware("auth")->group(function () {
    Route::get('/', [HomeController::class, 'root'])->name('root');

    // employee
    require __DIR__ . '/employee/personal-information.php';
    require __DIR__ . '/employee/bank-information.php';
    require __DIR__ . '/employee/leave-request.php';
    require __DIR__ . '/employee/retirement-request.php';

    // career
    require __DIR__ . '/career/transition.php';

    // management
    require __DIR__ . '/management/recruitment.php';
    require __DIR__ . '/management/career-transition.php';

    // payroll
    require __DIR__ . '/payroll/employee-payroll.php';
    require __DIR__ . '/payroll/payslip.php';

    // company setting
    require __DIR__ . '/master-data/payroll-period.php';

    // master-data
    require __DIR__ . '/master-data/users.php';
    require __DIR__ . '/master-data/job-position.php';
});
