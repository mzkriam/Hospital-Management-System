<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LaboratoryEmployeeLoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LaboratoryEmployeeController extends Controller
{
    public function store(LaboratoryEmployeeLoginRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::LaboratoryEmployee);
        } else {
            return redirect()->back()->withErrors(['name' => trans('Auth/auth.failed')]);
        }
    }
    public function destroy(Request $request)
    {
        Auth::guard('laboratory_employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
