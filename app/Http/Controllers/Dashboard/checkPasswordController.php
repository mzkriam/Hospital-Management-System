<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class checkPasswordController extends Controller
{
    public function enterPassword()
    {
        return view('Dashboard.enter_password_route');
    }
    public function checkPassword(Request $request)
    {
        $general_password = env('PASSWORD_LINK');
        if ($request->password == $general_password) {
            $user = Admin::find(auth()->user()->id);
            $user->password_route = 1;
            $user->save();
            return redirect()->route('admin.dashboard')->with('success', trans('Dashboard/dashboard.available'));
        } else {
            return redirect()->back()->with('danger', trans('Dashboard/dashboard.not_available'));
        }
    }
}
