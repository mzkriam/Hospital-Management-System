<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">
            <i class="fas fa-hospital"></i>
            <span class="font-weight-semibold mt-1 mb-0">Hospital</>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Auth -->
    <li class="nav-item">
        <div class="my-2">
            <div class="row">
                <div class="col-12 text-center">
                    <h4 class="text-gray-300">{{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <i class="icon-dashboard"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.index')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- medical_management-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSection" aria-expanded="true"
            aria-controls="collapseSection">
            <i class="fas fa-fw fa-table"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.medical_management')}}</span>
        </a>
        <div id="collapseSection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('Sections.index') }}">
                    {{trans('Dashboard/main-sidebar_trans.sections')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('Doctors.index') }}">
                    {{trans('Dashboard/main-sidebar_trans.doctors')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('adminPatients.index') }}">
                    {{trans('Dashboard/main-sidebar_trans.Patients')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_operation.index')}}">
                    {{trans('Dashboard/operations.operation')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_treatment.index')}}">
                    {{trans('Dashboard/operations.treatment')}}
                </a>
            </div>
        </div>
    </li>
    <!-- Service-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseService" aria-expanded="true"
            aria-controls="collapseService">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.Services')}}</span>
        </a>
        <div id="collapseService" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{Route('admin.service')}}">
                    {{trans('Dashboard/main-sidebar_trans.Single_service')}}
                </a>
                <a class="collapse-item text-light" href="{{Route('admin.Add_GroupServices')}}">
                    {{trans('Dashboard/main-sidebar_trans.group_services')}}
                </a>
                <a class="collapse-item text-light" href="{{Route('Ambulance.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.ambulance')}}
                </a>
            </div>
        </div>
    </li>
    <!-- financial_management-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseInsurance" aria-expanded="true"
            aria-controls="collapseInsurance">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.financial_management')}}</span>
        </a>
        <div id="collapseInsurance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{Route('adminInsurance.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.Insurance')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_single_invoices') }}">
                    {{trans('Dashboard/invoices.single_service_invoices')}}
                </a>
                <a class="collapse-item text-light" href="{{ Route('admin_group_invoices') }}">
                    {{trans('Dashboard/main-sidebar_trans.group_invoices')}}
                </a>
                <a class="collapse-item text-light" href="{{route('admin_invoices_patient.index') }}">
                    {{trans('Dashboard/invoices.debtor_invoices')}}
                </a>
                <a class="collapse-item text-light" href="{{route('admin_accounting.completedInvoice') }}">
                    {{trans('Dashboard/invoices.completed_invoice')}}
                </a>
            </div>
        </div>
    </li>
    {{-- administrative_management --}}
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAmbulance" aria-expanded="true"
            aria-controls="collapseAmbulance">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.administrative_management')}}</span>
        </a>
        <div id="collapseAmbulance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('reception_employee.index')}}">
                    {{trans('Dashboard/reception_employee.reception')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('ray_employee.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.ray')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('laboratory_employee.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.laboratory')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('accounting_employee.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.accounting')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('pharmacy_employee.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.pharmacy')}}
                </a>
            </div>
        </div>
    </li>
    {{-- pharmaceutical_management --}}
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseDoctor" aria-expanded="true"
            aria-controls="collapseDoctor">
            <i class="fas fa-fw fa-user"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.pharmaceutical_management')}}</span>
        </a>
        <div id="collapseDoctor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('admin_medicine.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.medicine')}}
                </a>
                <a class="collapse-item text-light" data-toggle="modal" data-target="#addMedicine ">
                    {{trans('Dashboard/medicine.add_medicine')}}
                </a>
            </div>
        </div>
    </li>
    {{-- appointments --}}
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAppointments" aria-expanded="true"
            aria-controls="collapseAppointments">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.appointments')}}</span>
        </a>
        <div id="collapseAppointments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('admin_appointments.internal') }}">
                    {{trans('Dashboard/main-sidebar_trans.internal_appointments')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_appointments.external') }}">
                    {{trans('Dashboard/main-sidebar_trans.external_appointments')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_appointments.uncertain') }}">
                    {{trans('Dashboard/appointments.uncertain_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_appointments.certain') }}">
                    {{trans('Dashboard/appointments.certain_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_appointments.expired_appointments') }}">
                    {{trans('Dashboard/appointments.expired_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('admin_appointments.canceled') }}">
                    {{trans('Dashboard/appointments.canceled_appointment')}}
                </a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    @include('Dashboard.Medicines.add')
    <!-- Sidebar Message -->
</ul>