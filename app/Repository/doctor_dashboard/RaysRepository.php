<?php

namespace App\Repository\doctor_dashboard;

use App\Events\TransferToRay;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\models\RayService;
use Illuminate\Support\Facades\DB;


class RaysRepository implements RaysRepositoryInterface
{
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $RayService = new RayService();
            $RayService->description = $request->description;
            $RayService->invoice_id = $request->invoice_id;
            $RayService->patient_id = $request->patient_id;
            $RayService->doctor_id = $request->doctor_id;
            $RayService->save();

            $notification_invoice = Notification::where('invoice_id', $RayService->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            $notifications = new Notification();
            $patient = Patient::find($RayService->patient_id);
            $notifications->invoice_id =  $RayService->invoice_id;
            $notifications->ray_service_id =  $RayService->id;
            $notifications->patient_id =  $RayService->patient_id;
            $notifications->section =  'ray';
            $notifications->message = "new x-ray examination: " . $patient->name;
            $notifications->save();

            // $data = [
            //     'patient' => $patient->id,
            //     'invoice_id' => $notifications->invoice_id,
            //     'ray_service_id' => $notifications->ray_service_id,
            // ];
            // event(new TransferToRay($data));
            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $Ray = RayService::findOrFail($id);
            $Ray->update([
                'description' => $request->description,
            ]);
            $notifications = Notification::where('ray_service_id', $Ray->id)->first();
            $patient = Patient::find($Ray->patient_id);
            $notifications->reader_status =  false;
            $notifications->invoice_id =  $Ray->invoice_id;
            $notifications->ray_service_id =  $Ray->id;
            $notifications->patient_id =  $Ray->patient_id;
            $notifications->section =  'ray';
            $notifications->message = "new x-ray examination: " . $patient->name;
            $notifications->save();

            $data = [
                'patient' => $patient->id,
                'invoice_id' => $notifications->invoice_id,
                'ray_service_id' => $notifications->ray_service_id,
            ];
            event(new TransferToRay($data));
            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $ray = RayService::findOrFail($id);
            $notifications = Notification::where('ray_service_id', $ray->id)->first();
            Notification::destroy($notifications->id);
            RayService::destroy($ray->id);
            DB::commit();
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
