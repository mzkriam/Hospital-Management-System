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
        <a class="nav-link" href="{{ route('patient.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <i class="icon-dashboard"></i>
            <span>
                {{trans('Dashboard/main-sidebar_trans.index')}}
            </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{trans('Dashboard/main-sidebar_trans.sections')}}
    </div>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAmbulance" aria-expanded="true"
            aria-controls="collapseAmbulance">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.medical_management')}}</span>
        </a>
        <div id="collapseAmbulance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light"
                    href="{{route('patient.invoices')}}">{{trans('Dashboard/invoices.list_of_invoices')}}</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseDoctor" aria-expanded="true"
            aria-controls="collapseDoctor">
            <i class="fas fa-fw fa-user"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.conversations')}}</span>
        </a>
        <div id="collapseDoctor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light"
                    href="{{route('list.doctors')}}">{{trans('Dashboard/main-sidebar_trans.doctors')}}</a>
                <a class="collapse-item text-light"
                    href="{{route('chat.doctors')}}">{{trans('Dashboard/main-sidebar_trans.last_conversations')}}</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
</ul>