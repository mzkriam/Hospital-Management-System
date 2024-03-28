<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Pharmacy_Employee\MedicineController;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'Pharmacy employee', 'middleware' => 'auth:pharmacy_employee'], (function () {
            Route::resource("medicine", MedicineController::class);
            Route::get("treatment/patient_medicines/{id}", [MedicineController::class, 'patient_treatment_medicines'])->name('patient_treatment_medicines');
            Route::get("operation/patient_medicines/{id}", [MedicineController::class, 'patient_operation_medicines'])->name('patient_operation_medicines');
            Route::post("operation/add_patient_medicines/{id}", [MedicineController::class, 'add_patient_operation_medicines'])->name('add_patient_operation_medicines');
            Route::post("treatment/add_patient_medicines/{id}", [MedicineController::class, 'add_patient_treatment_medicines'])->name('add_patient_treatment_medicines');
            Route::get("treatment/medicines", [MedicineController::class, 'treatmentMedicines'])->name('treatment.medicines');
            Route::get("operation/medicines", [MedicineController::class, 'operationMedicines'])->name('operation.medicines');
            Route::post("medicine/update_status", [MedicineController::class, 'update_status'])->name('medicine.update_status');
            Route::get('pha_view_notification/{id}', [MedicineController::class, 'viewNotification'])->name('pha_view_notification');

            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
