<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class CheckPassword
{

    public function handle(Request $request, Closure $next)
    {
        $user = Admin::find(auth()->user()->id);
        if ($user->password_route == 0) {
            return redirect()->route('enter-password-route');
        }
        return $next($request);
    }
}
