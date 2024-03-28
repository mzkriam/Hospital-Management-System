<?php

use App\Http\Controllers\Dashboard\checkPasswordController;
use App\Http\Middleware\CheckPassword;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceptionEmployeeController;
use App\Http\Controllers\Dashboard\PharmacyEmployeeController;
use App\Http\Controllers\Dashboard\AccountingEmployeeController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\Appointments\AppointmentController;
use App\Http\Controllers\Dashboard_Accounting_Employee\PatientAccountController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\Controllers\Dashboard_Laboratory_Employee\InvoiceLaboratoryEmployeeController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceRayEmployeeController;
use App\Http\Controllers\Dashboard_Pharmacy_Employee\MedicineController;
use App\Http\Controllers\Dashboard\OperationController;
use App\Http\Controllers\Dashboard\TreatmentController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth'])->name('user.login');

        Route::get('/outside-schedule', function () {
            return view('Dashboard.outside-schedule');
        })->name('outside-schedule');

        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('admin.login');

        Route::get('dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('admin.dashboard');


        Route::get('/dashboard/patient', function () {
            return view('Dashboard.dashboard_patient.dashboard');
        })->middleware(['auth:patient'])->name('patient.login');

        Route::get('dashboard/patient', function () {
            return view('Dashboard.dashboard_patient.dashboard');
        })->middleware(['auth:patient'])->name('patient.dashboard');

        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor'])->name('doctor.login');

        Route::get('dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor'])->name('doctor.dashboard');

        Route::get('/dashboard/ray_employee', function () {
            return view('Dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('ray_employee.login');

        Route::get('dashboard/ray_employee', function () {
            return view('Dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('ray_employee.dashboard');

        Route::get('/dashboard/laboratory_employee', function () {
            return view('Dashboard.dashboard_LaboratoryEmployee.dashboard');
        })->middleware(['auth:laboratory_employee'])->name('laboratory_employee.login');

        Route::get('dashboard/laboratory_employee', function () {
            return view('Dashboard.dashboard_LaboratoryEmployee.dashboard');
        })->middleware(['auth:laboratory_employee'])->name('laboratory_employee.dashboard');

        Route::get('/dashboard/pharmacy_employee', function () {
            return view('Dashboard.dashboard_Pharmacy_employee.dashboard');
        })->middleware(['auth:pharmacy_employee'])->name('pharmacy_employee.login');

        Route::get('dashboard/pharmacy_employee', function () {
            return view('Dashboard.dashboard_Pharmacy_employee.dashboard');
        })->middleware(['auth:pharmacy_employee'])->name('pharmacy_employee.dashboard');

        Route::get('/dashboard/reception_employee', function () {
            return view('Dashboard.dashboard_Reception_employee.dashboard');
        })->middleware(['auth:reception_employee'])->name('reception_employee.login');

        Route::get('dashboard/reception_employee', function () {
            return view('Dashboard.dashboard_Reception_employee.dashboard');
        })->middleware(['auth:reception_employee'])->name('reception.dashboard');

        Route::get('/dashboard/accounting_employee', function () {
            return view('Dashboard.dashboard_accounting_employee.dashboard');
        })->middleware(['auth:accounting_employee'])->name('accounting_employee.login');

        Route::get('dashboard/accounting_employee', function () {
            return view('Dashboard.dashboard_accounting_employee.dashboard');
        })->middleware(['auth:accounting_employee'])->name('accounting_employee.dashboard');

        Route::group(['middleware' => 'auth:admin'], (function () {
            Route::get('enter-password-route', [checkPasswordController::class, 'enterPassword'])->name('enter-password-route');
            Route::post('check.password', [checkPasswordController::class, 'checkPassword'])->name('check.password');
            Route::resource('Sections', SectionController::class);

            Route::post('doctor/update_status', [DoctorController::class, 'update_status'])->name('doctor.update_status')->middleware(CheckPassword::class);
            Route::post('doctor/update_password', [DoctorController::class, 'update_password'])->name('doctor.update_password')->middleware(CheckPassword::class);
            Route::get('doctor/showInvoices/{id}', [DoctorController::class, 'showInvoices'])->name('doctor.showInvoices');
            Route::get('doctor/reviewInvoices/{id}', [DoctorController::class, 'reviewInvoices'])->name('doctor.reviewInvoices');
            Route::get('doctor/completedInvoices/{id}', [DoctorController::class, 'completedInvoices'])->name('doctor.completedInvoices');
            Route::get('doctor/showRay/{id}', [DoctorController::class, 'showRay'])->name('doctor.showRay');
            Route::get('doctor/showLaboratory/{id}', [DoctorController::class, 'showLaboratory'])->name('doctor.showLaboratory');
            Route::get('doctor/showPatientDoctor/{id}', [DoctorController::class, 'showPatientDoctor'])->name('doctor.showPatientDoctor');
            Route::get('doctor/showTreatment/{id}', [DoctorController::class, 'showTreatment'])->name('doctor.showTreatment');
            Route::get('doctor/showOperation/{id}', [DoctorController::class, 'showOperation'])->name('doctor.showOperation');
            Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('admin.patient_details');
            Route::get('admin_doc_appointment/{id}', [DoctorController::class, 'showAppointments'])->name('admin_doc_appointment');
            Route::resource('Doctors', DoctorController::class);

            Route::view('service', 'livewire.Services.index')->name('admin.service');
            Route::view("Add_GroupServices", "livewire.GroupServices.include_create")->name("admin.Add_GroupServices");

            Route::post('Insurance/update_status', [InsuranceController::class, 'update_status'])->name('adminInsurance.update_status')->middleware(CheckPassword::class);
            Route::resource("adminInsurance", InsuranceController::class);

            Route::post('admin/Patients/update_status', [PatientController::class, 'update_status'])->name('adminPatients.update_status')->middleware(CheckPassword::class);
            Route::post('admin/Patients/update_password', [PatientController::class, 'update_password'])->name('adminPatients.update_password')->middleware(CheckPassword::class);
            Route::get("admin/Patients/appointments/{id}", [PatientController::class, 'appointments_patient'])->name('adminPatient.appointments_patient');
            Route::resource("adminPatients", PatientController::class);


            Route::view("appointments/internal", "livewire.appointments.internal.index")->name("admin_appointments.internal");
            Route::get('appointments/external', [AppointmentController::class, 'external'])->name('admin_appointments.external');
            Route::get('appointments/add_patient/{id}', [AppointmentController::class, 'add_patient'])->name('admin_appointments.add_patient');
            Route::delete('appointments/delete/{id}', [AppointmentController::class, 'destroy'])->name('admin_appointments.destroy')->middleware(CheckPassword::class);
            Route::post('appointments/update_status', [AppointmentController::class, 'update_status'])->name('admin_appointments.update_status')->middleware(CheckPassword::class);
            Route::post('appointments/appointment', [AppointmentController::class, 'appointment'])->name('admin_appointments.appointment')->middleware(CheckPassword::class);
            Route::get('appointments/certain', [AppointmentController::class, 'certain'])->name('admin_appointments.certain');
            Route::get('appointments/uncertain', [AppointmentController::class, 'uncertain'])->name('admin_appointments.uncertain');
            Route::get('appointments/canceled', [AppointmentController::class, 'canceled'])->name('admin_appointments.canceled');
            Route::get('appointments/expired_appointments', [AppointmentController::class, 'expired_appointments'])->name('admin_appointments.expired_appointments');


            Route::view('single_invoices', 'livewire.single_invoices.index')->name('admin_single_invoices');
            Route::view('Print_single_invoices', 'livewire.single_invoices.print')->name('admin_Print_single_invoices');
            Route::view('group_invoices', 'livewire.Group_invoices.index')->name('admin_group_invoices');
            Route::view('group_Print_single_invoices', 'livewire.Group_invoices.print')->name('admin_group_Print_single_invoices');

            Route::resource("admin_invoices_patient", PatientAccountController::class);
            Route::get("invoice_details\{id}", [PatientAccountController::class, 'showInvoice'])->name('admin_accounting.invoice_details');
            Route::get("patient_details\{id}", [PatientAccountController::class, 'show'])->name('admin_accounting.patient_details');
            Route::get("ReceiptVoucher\{id}", [PatientAccountController::class, 'ReceiptVoucher'])->name('admin_ReceiptVoucher');
            Route::get("completedInvoice", [PatientAccountController::class, 'completedInvoice'])->name('admin_accounting.completedInvoice');

            Route::resource("admin_Receipt", ReceiptAccountController::class);
            Route::resource("admin_Payment", PaymentAccountController::class);

            Route::resource('admin_invoices', InvoiceController::class);
            Route::get('show_laboratory/{id}', [InvoiceController::class, 'showPatientLaboratory'])->name('admin_showLaboratory');

            Route::get('completed_ray', [InvoiceRayEmployeeController::class, 'completedRay'])->name('admin_completed_ray');
            Route::get('view_ray/{id}', [InvoiceRayEmployeeController::class, 'viewRay'])->name('admin_view_ray');
            Route::get('view_required/{id}', [InvoiceRayEmployeeController::class, 'viewRequired'])->name('admin_view_required');
            Route::resource('admin_invoice_ray_employee', InvoiceRayEmployeeController::class);

            Route::get('completed_invoices_laboratory_employee', [InvoiceLaboratoryEmployeeController::class, 'completedInvoicesLaboratoryEmployee'])->name('admin_completed_invoices_laboratory_employee');
            Route::get('view_laboratories/{id}', [InvoiceLaboratoryEmployeeController::class, 'viewLaboratory'])->name('admin_view_laboratories');
            Route::get('viewRequired/{id}', [InvoiceLaboratoryEmployeeController::class, 'viewRequired'])->name('admin_viewRequired');
            Route::resource('a_invoices_laboratory_employee', InvoiceLaboratoryEmployeeController::class);

            Route::get("treatment/patient_medicines/{id}", [MedicineController::class, 'patient_treatment_medicines'])->name('admin_patient_treatment_medicines');
            Route::get("operation/patient_medicines/{id}", [MedicineController::class, 'patient_operation_medicines'])->name('admin_patient_operation_medicines');
            Route::get("treatment/medicines", [MedicineController::class, 'treatmentMedicines'])->name('admin_treatment.medicines');
            Route::get("operation/medicines", [MedicineController::class, 'operationMedicines'])->name('admin_operation.medicines');
            Route::post("medicine/update_status", [MedicineController::class, 'update_status'])->name('admin_medicine.update_status')->middleware(CheckPassword::class);
            Route::resource("admin_medicine", MedicineController::class);

            Route::post('lab_employee/update_status', [LaboratoryEmployeeController::class, 'update_status'])->name('lab_employee.update_status')->middleware(CheckPassword::class);
            Route::post('lab_employee/update_password', [LaboratoryEmployeeController::class, 'update_password'])->name('lab_employee.update_password')->middleware(CheckPassword::class);
            Route::get('admin_lab_appointment/{id}', [LaboratoryEmployeeController::class, 'showAppointments'])->name('admin_lab_appointment');
            Route::resource("laboratory_employee", LaboratoryEmployeeController::class);

            Route::post('ray_employee/update_status', [RayEmployeeController::class, 'update_status'])->name('ray_employee.update_status')->middleware(CheckPassword::class);
            Route::post('ray_employee/update_password', [RayEmployeeController::class, 'update_password'])->name('ray_employee.update_password')->middleware(CheckPassword::class);
            Route::get('admin_ray_appointment/{id}', [RayEmployeeController::class, 'showAppointments'])->name('admin_ray_appointment');
            Route::resource("ray_employee", RayEmployeeController::class);

            Route::post('accounting_employee/update_status', [AccountingEmployeeController::class, 'update_status'])->name('accounting_employee.update_status')->middleware(CheckPassword::class);
            Route::post('accounting_employee/update_password', [AccountingEmployeeController::class, 'update_password'])->name('accounting_employee.update_password')->middleware(CheckPassword::class);
            Route::resource("accounting_employee", AccountingEmployeeController::class);
            Route::get('showInvoices/{id}', [AccountingEmployeeController::class, 'showInvoices'])->name('accounting_employee.showInvoices');
            Route::get('reviewInvoices/{id}', [AccountingEmployeeController::class, 'reviewInvoices'])->name('accounting_employee.reviewInvoices');
            Route::get('completedInvoices/{id}', [AccountingEmployeeController::class, 'completedInvoices'])->name('accounting_employee.completedInvoices');
            Route::get('showRay/{id}', [AccountingEmployeeController::class, 'showRay'])->name('accounting_employee.showRay');
            Route::get('showLaboratory/{id}', [AccountingEmployeeController::class, 'showLaboratory'])->name('accounting_employee.showLaboratory');
            Route::get('showPatientDoctor/{id}', [AccountingEmployeeController::class, 'showPatientDoctor'])->name('accounting_employee.showPatientDoctor');
            Route::get('showTreatment/{id}', [AccountingEmployeeController::class, 'showTreatment'])->name('accounting_employee.showTreatment');
            Route::get('admin_acc_appointment/{id}', [AccountingEmployeeController::class, 'showAppointments'])->name('admin_acc_appointment');

            Route::post('pharmacy_employee/update_status', [PharmacyEmployeeController::class, 'update_status'])->name('pharmacy_employee.update_status')->middleware(CheckPassword::class);
            Route::post('pharmacy_employee/update_password', [PharmacyEmployeeController::class, 'update_password'])->name('pharmacy_employee.update_password')->middleware(CheckPassword::class);
            Route::get('admin_pha_appointment/{id}', [PharmacyEmployeeController::class, 'showAppointments'])->name('admin_pha_appointment');
            Route::resource("pharmacy_employee", PharmacyEmployeeController::class);

            Route::post('reception_employee/update_status', [ReceptionEmployeeController::class, 'update_status'])->name('reception_employee.update_status')->middleware(CheckPassword::class);
            Route::post('reception_employee/update_password', [ReceptionEmployeeController::class, 'update_password'])->name('reception_employee.update_password')->middleware(CheckPassword::class);
            Route::get('admin_res_appointment/{id}', [ReceptionEmployeeController::class, 'showAppointments'])->name('admin_res_appointment');
            Route::resource("reception_employee", ReceptionEmployeeController::class);

            Route::resource("admin_treatment", TreatmentController::class);
            Route::resource("admin_operation", OperationController::class);

            Route::resource("Ambulance", AmbulanceController::class);
        }));
        require __DIR__ . '/auth.php';
    }
);
