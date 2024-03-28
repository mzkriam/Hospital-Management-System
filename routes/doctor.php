<?php

use App\Http\Controllers\Dashboard\OperationController;
use App\Http\Controllers\Dashboard\TreatmentController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\LaboratoriesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\livewire\Chat\CreateChat;
use App\Http\livewire\Chat\Main;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doctor', 'check-time:doctor']], (function () {
            Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('patient_details');
            Route::get('invoice_details/{id}', [PatientDetailsController::class, 'invoice_details'])->name('invoice_details');
            Route::get("doctor/add_operation/{id}", [OperationController::class, 'add'])->name('doctor.addOperation');
            Route::resource("operation", OperationController::class);
            Route::get('completed_invoices', [InvoiceController::class, 'completedInvoices'])->name('completedInvoices');
            Route::get('review_invoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');
            Route::get('show_laboratory/{id}', [InvoiceController::class, 'showPatientLaboratory'])->name('showLaboratory');
            Route::resource('invoices', InvoiceController::class);
            Route::get('treatment/add_treatment/{id}', [TreatmentController::class, 'add'])->name('treatment.add');
            Route::get('treatment/add_a_review/{id}', [TreatmentController::class, 'add_a_review'])->name('treatment.add_a_review');
            Route::post('treatment/add_a_review/', [TreatmentController::class, 'storeReview'])->name('treatment.storeReview');
            Route::resource("treatment", TreatmentController::class);
            Route::resource('rays', RayController::class);
            Route::resource('Laboratories', LaboratoriesController::class);
            Route::get('list/patients', CreateChat::class)->name('list.patients');
            Route::get('chat/patients', Main::class)->name('chat.patients');
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
