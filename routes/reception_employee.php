<?php

use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\Appointments\AppointmentController;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'Reception employee', 'middleware' => 'auth:reception_employee'], (function () {
            Route::post('Patients/update_status', [PatientController::class, 'update_status'])->name('Patients.update_status');
            Route::post('Patients/update_password', [PatientController::class, 'update_password'])->name('Patients.update_password');
            Route::get("Patients/appointments/{id}", [PatientController::class, 'appointments_patient'])->name('patient.appointments_patient');
            Route::resource("Patients", PatientController::class);

            Route::view("appointments/internal", "livewire.appointments.internal.index")->name("appointments.internal");
            Route::get('appointments/external', [AppointmentController::class, 'external'])->name('appointments.external');
            Route::get('appointments/add_patient/{id}', [AppointmentController::class, 'add_patient'])->name('appointments.add_patient');
            Route::delete('appointments/delete/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
            Route::post('appointments/update_status', [AppointmentController::class, 'update_status'])->name('appointments.update_status');
            Route::post('appointments/appointment', [AppointmentController::class, 'appointment'])->name('appointments.appointment');
            Route::get('appointments/certain', [AppointmentController::class, 'certain'])->name('appointments.certain');
            Route::get('appointments/uncertain', [AppointmentController::class, 'uncertain'])->name('appointments.uncertain');
            Route::get('appointments/canceled', [AppointmentController::class, 'canceled'])->name('appointments.canceled');
            Route::get('appointments/expired_appointments', [AppointmentController::class, 'expired_appointments'])->name('appointments.expired_appointments');

            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
