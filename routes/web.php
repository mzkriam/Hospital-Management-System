<?php


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', function () {
            return view('welcome');
        });
    }
);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
