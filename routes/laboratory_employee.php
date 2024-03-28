<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Laboratory_Employee\InvoiceLaboratoryEmployeeController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'laboratory employee', 'middleware' => 'auth:laboratory_employee'], (function () {
            Route::get('completed_invoices_laboratory_employee', [InvoiceLaboratoryEmployeeController::class, 'completedInvoicesLaboratoryEmployee'])->name('completed_invoices_laboratory_employee');
            Route::get('view_laboratories/{id}', [InvoiceLaboratoryEmployeeController::class, 'viewLaboratory'])->name('view_laboratories');
            Route::get('lab_view_required/{id}', [InvoiceLaboratoryEmployeeController::class, 'viewRequired'])->name('lab_view_required');
            Route::get('lab_view_notification/{id}', [InvoiceLaboratoryEmployeeController::class, 'viewNotification'])->name('lab_view_notification');
            Route::resource('invoices_laboratory_employee', InvoiceLaboratoryEmployeeController::class);
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
