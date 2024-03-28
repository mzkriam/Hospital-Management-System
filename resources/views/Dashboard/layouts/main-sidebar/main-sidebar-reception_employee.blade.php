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
                    <h6 class="text-gray-300">{{ Auth::user()->name }}</h6>
                </div>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('reception.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <i class="icon-dashboard"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.index')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{trans('Dashboard/main-sidebar_trans.sections')}}
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAppointments" aria-expanded="true"
            aria-controls="collapseAppointments">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.appointments')}}</span>
        </a>
        <div id="collapseAppointments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('appointments.internal') }}">
                    {{trans('Dashboard/main-sidebar_trans.internal_appointments')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('appointments.external') }}">
                    {{trans('Dashboard/main-sidebar_trans.external_appointments')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('appointments.uncertain') }}">
                    {{trans('Dashboard/appointments.uncertain_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('appointments.certain') }}">
                    {{trans('Dashboard/appointments.certain_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('appointments.expired_appointments') }}">
                    {{trans('Dashboard/appointments.expired_appointment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('appointments.canceled') }}">
                    {{trans('Dashboard/appointments.canceled_appointment')}}
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true"
            aria-controls="collapsePatient">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.Patients')}}</span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('Patients.index') }}">
                    {{trans('Dashboard/patients.patients')}}
                </a>
                <a class="collapse-item text-light" href="{{route('Patients.create')}}">
                    {{trans('Dashboard/patients.add_patient')}}
                </a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
</ul>