<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;


class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        if (auth('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN);
        }
        if (auth('doctor')->check()) {
            return redirect(RouteServiceProvider::DOCTOR);
        }
        if (auth('ray_employee')->check()) {
            return redirect(RouteServiceProvider::RayEmployee);
        }
        if (auth('laboratory_employee')->check()) {
            return redirect(RouteServiceProvider::LaboratoryEmployee);
        }
        if (auth('reception_employee')->check()) {
            return redirect(RouteServiceProvider::ReceptionEmployee);
        }
        if (auth('accounting_employee')->check()) {
            return redirect(RouteServiceProvider::AccountingEmployee);
        }
        if (auth('pharmacy_employee')->check()) {
            return redirect(RouteServiceProvider::PharmacyEmployee);
        }
        if (auth('patient')->check()) {
            return redirect(RouteServiceProvider::PATIENT);
        }
        return $next($request);
    }
}
