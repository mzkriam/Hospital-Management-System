<?php

namespace App\Providers;

use App\Interfaces\AccountingEmployee\invoices\PatientAccountRepositoryInterface;
use App\Interfaces\ray_employee_dashboard\RayServiceRepositoryInterface;
use App\Repository\ray_employee_dashboard\RayServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Repository\Sections\SectionRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Repository\Doctors\DoctorsRepository;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Repository\Services\SingleServiceRepository;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Repository\Insurances\InsuranceRepository;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Repository\Ambulance\AmbulanceRepository;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Repository\Patients\PatientRepository;
use App\Interfaces\Finance\FinanceRepositoryInterface;
use App\Repository\Finance\FinanceRepository;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Repository\Finance\PaymentRepository;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Repository\doctor_dashboard\InvoicesRepository;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Repository\doctor_dashboard\DiagnosisRepository;
use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Repository\doctor_dashboard\RaysRepository;
use App\Interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;
use App\Repository\doctor_dashboard\LaboratoriesRepository;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Repository\RayEmployee\RayEmployeeRepository;
use App\Interfaces\ray_employee_dashboard\InvoiceRayEmployeeRepositoryInterface;
use App\Repository\ray_employee_dashboard\InvoiceRayEmployeeRepository;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Repository\LaboratoryEmployee\LaboratoryEmployeeRepository;
use App\Interfaces\PharmacyEmployee\PharmacyEmployeeRepositoryInterface;
use App\Repository\PharmacyEmployee\PharmacyEmployeeRepository;
use App\Interfaces\laboratory_employee_dashboard\InvoiceLaboratoryEmployeeRepositoryInterface;
use App\Repository\laboratory_employee_dashboard\InvoiceLaboratoryEmployeeRepository;
use App\Interfaces\patient_dashboard\InvoicePatientRepositoryInterface;
use App\Repository\patient_dashboard\InvoicePatientRepository;
use App\Interfaces\laboratory_employee_dashboard\LaboratoryServiceRepositoryInterface;
use App\Repository\laboratory_employee_dashboard\LaboratoryServiceRepository;
use App\Interfaces\Operations\OperationRepositoryInterface;
use App\Repository\Operations\OperationRepository;
use App\Interfaces\Treatments\TreatmentRepositoryInterface;
use App\Repository\Treatments\TreatmentRepository;
use App\Interfaces\Pharmacy_employee_dashboard\MedicineRepositoryInterface;
use App\Interfaces\ReceptionEmployee\ReceptionEmployeeRepositoryInterface;
use App\Repository\Pharmacy_employee_dashboard\MedicineRepository;
use App\Repository\ReceptionEmployee\ReceptionEmployeeRepository;
use App\Repository\AccountingEmployee\AccountingEmployeeRepository;
use App\Interfaces\AccountingEmployee\AccountingEmployeeRepositoryInterface;
use App\Repository\AccountingEmployee\invoices\PatientAccountRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorsRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(FinanceRepositoryInterface::class, FinanceRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        $this->app->bind(DiagnosisRepositoryInterface::class, DiagnosisRepository::class);
        $this->app->bind(RaysRepositoryInterface::class, RaysRepository::class);
        $this->app->bind(LaboratoriesRepositoryInterface::class, LaboratoriesRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);
        $this->app->bind(InvoiceRayEmployeeRepositoryInterface::class, InvoiceRayEmployeeRepository::class);
        $this->app->bind(LaboratoryEmployeeRepositoryInterface::class, LaboratoryEmployeeRepository::class);
        $this->app->bind(InvoiceLaboratoryEmployeeRepositoryInterface::class, InvoiceLaboratoryEmployeeRepository::class);
        $this->app->bind(InvoicePatientRepositoryInterface::class, InvoicePatientRepository::class);
        $this->app->bind(PharmacyEmployeeRepositoryInterface::class, PharmacyEmployeeRepository::class);
        $this->app->bind(RayServiceRepositoryInterface::class, RayServiceRepository::class);
        $this->app->bind(LaboratoryServiceRepositoryInterface::class, LaboratoryServiceRepository::class);
        $this->app->bind(MedicineRepositoryInterface::class, MedicineRepository::class);
        $this->app->bind(OperationRepositoryInterface::class, OperationRepository::class);
        $this->app->bind(TreatmentRepositoryInterface::class, TreatmentRepository::class);
        $this->app->bind(ReceptionEmployeeRepositoryInterface::class, ReceptionEmployeeRepository::class);
        $this->app->bind(AccountingEmployeeRepositoryInterface::class, AccountingEmployeeRepository::class);
        $this->app->bind(PatientAccountRepositoryInterface::class, PatientAccountRepository::class);
    }
    public function boot()
    {
        //
    }
}
