<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard_Laboratory_Employee\LaboratoryServiceController;
use App\Http\Controllers\Dashboard_Ray_Employee\RayServiceController;
use App\Http\Controllers\Dashboard_Accounting_Employee\PatientAccountController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\OperationController;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'accounting employee', 'middleware' => 'auth:accounting_employee'], (function () {
            Route::post('Insurance/update_status', [InsuranceController::class, 'update_status'])->name('Insurance.update_status');
            Route::resource("Insurance", InsuranceController::class);

            Route::post("ray_service/update_status", [RayServiceController::class, 'update_status'])->name('ray_service.update_status');
            Route::resource("ray_service", RayServiceController::class);

            Route::post("laboratory_service/update_status", [LaboratoryServiceController::class, 'update_status'])->name('laboratory_service.update_status');
            Route::resource("laboratory_service", LaboratoryServiceController::class);

            Route::view('service', 'livewire.Services.index')->name('service');
            Route::view("Add_GroupServices", "livewire.GroupServices.include_create")->name("Add_GroupServices");

            Route::view('single_invoices', 'livewire.single_invoices.index')->name('single_invoices');
            Route::view('Print_single_invoices', 'livewire.single_invoices.print')->name('Print_single_invoices');
            Route::view('group_invoices', 'livewire.Group_invoices.index')->name('group_invoices');
            Route::view('group_Print_single_invoices', 'livewire.Group_invoices.print')->name('group_Print_single_invoices');

            Route::resource("invoices_patient", PatientAccountController::class);
            Route::get("invoice_details\{id}", [PatientAccountController::class, 'showInvoice'])->name('accounting.invoice_details');
            Route::get("patient_details\{id}", [PatientAccountController::class, 'show'])->name('accounting.patient_details');
            Route::get("ReceiptVoucher\{id}", [PatientAccountController::class, 'ReceiptVoucher'])->name('ReceiptVoucher');
            Route::get("completedInvoice", [PatientAccountController::class, 'completedInvoice'])->name('accounting.completedInvoice');

            Route::resource("Receipt", ReceiptAccountController::class);
            Route::resource("Payment", PaymentAccountController::class);

            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
