<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;
use App\Models\LabService;
use App\Events\TransferToLaboratory;
use App\Models\Notification;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;


class  LaboratoriesRepository implements LaboratoriesRepositoryInterface
{
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $LabService = new LabService();
            $LabService->description  =  $request->description;
            $LabService->invoice_id =  $request->invoice_id;
            $LabService->patient_id =  $request->patient_id;
            $LabService->doctor_id = $request->doctor_id;
            $LabService->save();

            $notification_invoice = Notification::where('invoice_id', $LabService->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            $notifications = new Notification();
            $patient = Patient::find($LabService->patient_id);
            $notifications->invoice_id =  $LabService->invoice_id;
            $notifications->lab_service_id =  $LabService->id;
            $notifications->patient_id =  $LabService->patient_id;
            $notifications->section =  'laboratory';
            $notifications->message = "new laboratory examination: " . $patient->name;
            $notifications->save();

            // $data = [
            //     'patient' =>  $LabService->patient_id,
            //     'invoice_id' =>  $LabService->invoice_id,
            //     'lab_service_id' =>  $notifications->lab_service_id,
            // ];
            // event(new TransferToLaboratory($data));
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
            $Laboratory = LabService::findOrFail($id);
            $Laboratory->update([
                'description' => $request->description,
            ]);

            $notifications = Notification::where('lab_service_id', $Laboratory->id)->first();
            $patient = Patient::find($Laboratory->patient_id);
            $notifications->reader_status =  false;
            $notifications->invoice_id =  $Laboratory->invoice_id;
            $notifications->lab_service_id =  $Laboratory->id;
            $notifications->patient_id =  $Laboratory->patient_id;
            $notifications->section =  'Laboratory';
            $notifications->message = "new Laboratory examination: " . $patient->name;
            $notifications->save();

            $data = [
                'patient' => $patient->id,
                'invoice_id' => $notifications->invoice_id,
                'lab_service_id' => $notifications->lab_service_id,
            ];
            event(new TransferToLaboratory($data));
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
            $laboratory = LabService::findOrFail($id);
            $notification = Notification::where('lab_service_id', $laboratory->id)->first();
            Notification::destroy($notification->id);
            LabService::destroy($laboratory->id);
            DB::commit();
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
