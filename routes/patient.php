<?php

use App\Http\Controllers\Dashboard_Patient\InvoicePatientController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'Patient', 'middleware' => 'auth:patient'], (function () {
            Route::get('patient/invoices', [InvoicePatientController::class, 'invoices'])->name('patient.invoices');
            Route::get('patient/showInvoice', [InvoicePatientController::class, 'showInvoice'])->name('patient.invoices_record');
            Route::get('patient/laboratory/{id}', [InvoicePatientController::class, 'laboratoryInformation'])->name('patient.showLaboratory');
            Route::get('patient/ray/{id}', [InvoicePatientController::class, 'rayInformation'])->name('showRay');

            Route::get('list/doctors', CreateChat::class)->name('list.doctors');
            Route::get('chat/doctors', Main::class)->name('chat.doctors');

            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
    }
);
