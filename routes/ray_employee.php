<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceRayEmployeeController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'ray employee', 'middleware' => 'auth:ray_employee'], (function () {
            Route::get('completed_ray', [InvoiceRayEmployeeController::class, 'completedRay'])->name('completed_ray');
            Route::get('view_ray/{id}', [InvoiceRayEmployeeController::class, 'viewRay'])->name('view_ray');
            Route::get('ray_view_required/{id}', [InvoiceRayEmployeeController::class, 'viewRequired'])->name('ray_view_required');
            Route::get('ray_view_notification/{id}', [InvoiceRayEmployeeController::class, 'viewNotification'])->name('ray_view_notification');
            Route::resource('invoice_ray_employee', InvoiceRayEmployeeController::class);
            Route::get('/404', function () {
                return view('Dashboard.404');
            })->name('404');
        }));
        require __DIR__ . '/auth.php';
    }
);
