<?php

namespace App\Http\Controllers\Dashboard\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Insurance;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function external()
    {
        try {
            $appointments = Appointment::where('method', 1)->orderBy('appointment', 'asc')
                ->get();
            return view('Dashboard.appointments.Table', compact('appointments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function add_patient($id)
    {
        try {
            $insurances = Insurance::get();
            $appointment = Appointment::findOrFail($id);
            return view('Dashboard.appointments.add_patient', compact('appointment', 'insurances'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            Appointment::destroy($id);
            session()->flash("delete");
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.external');
            } else {
                return redirect()->route('appointments.external');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'status' => 'required|in:uncertain,certain,expired,canceled',
            ]
        );
        try {
            $appointment = Appointment::findOrFail($request->id);
            $appointment->update([
                'type' => $request->status
            ]);
            if (auth('admin')->check()) {
                $appointment->reception_id = NULL;
                $appointment->admin_id = auth()->user()->id;
            } else {
                $appointment->admin_id = NULL;
                $appointment->reception_id = auth()->user()->id;
            }
            $appointment->save();
            session()->flash("edit");
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.external');
            } else {
                return redirect()->route('appointments.external');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function appointment(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'appointment' => 'required|date_format:Y-m-d\TH:i',
            ]
        );
        try {
            $appointment = Appointment::findOrFail($request->id);
            $appointment->type = 'certain';
            $appointment->appointment = $request->appointment;
            if (auth('admin')->check()) {
                $appointment->reception_id = NULL;
                $appointment->admin_id = auth()->user()->id;
            } else {
                $appointment->admin_id = NULL;
                $appointment->reception_id = auth()->user()->id;
            }
            $appointment->save();
            session()->flash("edit");
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.external');
            } else {
                return redirect()->route('appointments.external');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function certain()
    {
        try {
            $appointments = Appointment::where('type', 'certain')
                ->orderBy('appointment', 'asc')
                ->get();

            return view('Dashboard.appointments.certain', compact('appointments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function uncertain()
    {
        try {
            $appointments = Appointment::where('type', 'uncertain')->orderBy('appointment', 'asc')
                ->get();
            return view('Dashboard.appointments.uncertain', compact('appointments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function canceled()
    {
        try {
            $appointments = Appointment::where('type', 'canceled')->orderBy('appointment', 'asc')
                ->get();
            return view('Dashboard.appointments.canceled', compact('appointments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function expired_appointments()
    {
        try {
            $appointments = Appointment::where('type', 'expired')->orderBy('appointment', 'asc')
                ->get();
            return view('Dashboard.appointments.expired_appointments', compact('appointments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function approval(Request $request, $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->update([
                'type' => 'certain',
                'appointment' => $request->appointment
            ]);
            if (auth('admin')->check()) {
                $appointment->reception_id = NULL;
                $appointment->admin_id = auth()->user()->id;
            } else {
                $appointment->admin_id = NULL;
                $appointment->reception_id = auth()->user()->id;
            }
            $appointment->save();
            // Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment->name, $appointment->appointment));
            // send message mob
            // $receiverNumber = $appointment->phone;
            // $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;

            // $account_sid = getenv("TWILIO_SID");
            // $auth_token = getenv("TWILIO_TOKEN");
            // $twilio_number = getenv("TWILIO_FROM");
            // $client = new Client($account_sid, $auth_token);
            // $client->messages->create($receiverNumber, [
            //     'from' => $twilio_number,
            //     'body' => $message
            // ]);
            session()->flash('add');
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.external');
            } else {
                return redirect()->route('appointments.external');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        };
    }
}
