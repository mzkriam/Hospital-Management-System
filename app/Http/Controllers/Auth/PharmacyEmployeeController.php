<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PharmacyEmployeeLoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class PharmacyEmployeeController extends Controller
{
    public function store(PharmacyEmployeeLoginRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::PharmacyEmployee);
        } else {
            return redirect()->back()->withErrors(['name' => trans('Auth/auth.failed')]);
        }
    }
    public function destroy(Request $request)
    {
        Auth::guard('pharmacy_employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
