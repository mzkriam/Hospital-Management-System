<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RayEmployeeLoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RayEmployeeController extends Controller
{
    public function store(RayEmployeeLoginRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::RayEmployee);
        } else {
            return redirect()->back()->withErrors(['name' => trans('Auth/auth.failed')]);
        }
    }
    public function destroy(Request $request)
    {
        Auth::guard('ray_employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
