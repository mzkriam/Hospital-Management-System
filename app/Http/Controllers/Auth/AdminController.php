<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function store(AdminLoginRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else {
            return redirect()->back()->withErrors(['name' => trans('Auth/auth.failed')]);
        }
    }
    public function destroy(Request $request)
    {
        $user = Admin::find(auth()->user()->id);
        if ($user->password_route == 1) {
            $user->password_route = 0;
            $user->save();
        }
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
