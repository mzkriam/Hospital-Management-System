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
        <a class="nav-link" href="{{ route('doctor.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <i class="icon-dashboard"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.index')}}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{trans('Dashboard/main-sidebar_trans.sections')}}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSection" aria-expanded="true"
            aria-controls="collapseSection">
            <i class="fas fa-fw fa-table"></i>
            <span>{{trans('Dashboard/invoices.examinations')}}</span>
        </a>
        <div id="collapseSection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('invoices.index') }}">
                    {{trans('Dashboard/invoices.medical_examinations')}}
                </a>
                <a class="collapse-item text-light" href="{{route('reviewInvoices') }}">
                    {{trans('Dashboard/invoices.medical_reviews')}}
                </a>
                <a class="collapse-item text-light" href="{{route('completedInvoices') }}">
                    {{trans('Dashboard/invoices.completed_examinations')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('treatment.index')}}">
                    {{trans('Dashboard/operations.treatment')}}
                </a>
                <a class="collapse-item text-light" href="{{ route('operation.index')}}">
                    {{trans('Dashboard/operations.operation')}}
                </a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseDoctor" aria-expanded="true"
            aria-controls="collapseDoctor">
            <i class="fas fa-fw fa-user"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.conversations')}}</span>
        </a>
        <div id="collapseDoctor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('list.patients')}}">
                    {{trans('Dashboard/main-sidebar_trans.Patients')}}
                </a>
                <a class="collapse-item text-light" href="{{route('chat.patients')}}">
                    {{trans('Dashboard/main-sidebar_trans.last_conversations')}}
                </a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
</ul>