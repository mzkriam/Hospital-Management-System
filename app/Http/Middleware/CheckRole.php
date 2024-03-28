<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // if (!Auth::check())
        //     return redirect('login');
        // if ($request->user()->role != $role)
        //     return redirect('login');
        // return $next($request);
    }
}
