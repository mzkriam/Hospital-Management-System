<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\RayEmployeeController;
use App\Http\Controllers\Auth\LaboratoryEmployeeController;
use App\Http\Controllers\Auth\PatientController;
use App\Http\Controllers\Auth\PharmacyEmployeeController;
use App\Http\Controllers\Auth\ReceptionEmployeeController;
use App\Http\Controllers\Auth\AccountingEmployeeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['guest', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Rote User
        Route::post('/user/login', [AuthenticatedSessionController::class, 'store'])->name('user.login');
        // Route Admin
        Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
        //Rote Patient
        Route::post('/patient/login', [PatientController::class, 'store'])->name('patient.login');
        // Route doctor
        Route::post('/doctor/login', [DoctorController::class, 'store'])->name('doctor.login');
        //Rote ray employee
        Route::post('/ray_employee/login', [RayEmployeeController::class, 'store'])->name('ray_employee.login');
        //Rote ray employee
        Route::post('/ray_employee/login', [RayEmployeeController::class, 'store'])->name('ray_employee.login');
        //Rote Laboratory employee
        Route::post('/laboratory_employee/login', [LaboratoryEmployeeController::class, 'store'])->name('laboratory_employee.login');
        //Rote Laboratory employee
        Route::post('/pharmacy_employee/login', [PharmacyEmployeeController::class, 'store'])->name('pharmacy_employee.login');
        //Rote Laboratory employee
        Route::post('/reception_employee/login', [ReceptionEmployeeController::class, 'store'])->name('reception_employee.login');

        Route::post('/accounting_employee/login', [AccountingEmployeeController::class, 'store'])->name('accounting_employee.login');

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    }
);

Route::middleware('auth')->group(
    function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.user');
    }
);
Route::middleware('auth:admin')->group(
    function () {
        Route::post('/admin/logout', [AdminController::class, 'destroy'])->name('logout.admin');
    }
);
Route::middleware('auth:patient')->group(function () {
    Route::post('/logout/patient', [PatientController::class, 'destroy'])->name('logout.patient');
});
Route::middleware('auth:doctor')->group(
    function () {
        Route::post('/logout/doctor', [DoctorController::class, 'destroy'])->name('logout.doctor');
    }
);
Route::middleware('auth:ray_employee')->group(function () {
    Route::post('/logout/ray_employee', [RayEmployeeController::class, 'destroy'])->name('logout.ray_employee');
});
Route::middleware('auth:laboratory_employee')->group(function () {
    Route::post('/logout/laboratory_employee', [LaboratoryEmployeeController::class, 'destroy'])->name('logout.laboratory_employee');
});
Route::middleware('auth:pharmacy_employee')->group(function () {
    Route::post('/logout/pharmacy_employee', [PharmacyEmployeeController::class, 'destroy'])->name('logout.pharmacy_employee');
});
Route::middleware('auth:reception_employee')->group(function () {
    Route::post('/logout/reception_employee', [ReceptionEmployeeController::class, 'destroy'])->name('logout.reception_employee');
});
Route::middleware('auth:accounting_employee')->group(function () {
    Route::post('/logout/accounting_employee', [AccountingEmployeeController::class, 'destroy'])->name('logout.accounting_employee');
});
