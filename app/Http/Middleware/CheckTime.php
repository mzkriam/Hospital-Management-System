<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use \App\Models\Doctor;

class CheckTime
{
    public function handle($request, Closure $next, $user)
    {
        // if ($user == 'doctor') {
        //     // $doctor = Auth::user();
        //     $doctor = Doctor::find(auth()->user()->id);
        //     $now = Carbon::now();
        //     $schedule = $doctor->schedules()
        //         ->where('day', $now->dayOfWeek)
        //         ->first();

        //     if (!$schedule) {
        //         return redirect()->route('outside-schedule',);
        //     }

        //     $startTime = Carbon::createFromFormat('H:i:s', $schedule->start_time);
        //     $endTime = Carbon::createFromFormat('H:i:s', $schedule->end_time);

        //     if ($now->between($startTime, $endTime)) {
        //         return $next($request);
        //     }
        //     return redirect()->route('outside-schedule');
        // }
        return $next($request);
    }
}
