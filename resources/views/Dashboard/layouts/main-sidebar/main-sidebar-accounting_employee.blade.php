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
        <a class="nav-link" href="{{ route('accounting_employee.dashboard') }}">
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
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAmbulance" aria-expanded="true"
            aria-controls="collapseAmbulance">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.Insurance')}}</span>
        </a>
        <div id="collapseAmbulance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{Route('Insurance.index')}}">
                    {{trans('Dashboard/main-sidebar_trans.view_all')}}
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseService" aria-expanded="true"
            aria-controls="collapseService">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/main-sidebar_trans.Services')}}</span>
        </a>
        <div id="collapseService" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{Route('service')}}">
                    {{trans('Dashboard/main-sidebar_trans.Single_service')}}
                </a>
                <a class="collapse-item text-light" href="{{Route('Add_GroupServices')}}">
                    {{trans('Dashboard/main-sidebar_trans.group_services')}}
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseInvoice" aria-expanded="true"
            aria-controls="collapseInvoice">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/invoices.list_of_invoices')}}</span>
        </a>
        <div id="collapseInvoice" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('single_invoices') }}">
                    {{trans('Dashboard/invoices.single_service_invoices')}}
                </a>
                <a class="collapse-item text-light" href="{{ Route('group_invoices') }}">
                    {{trans('Dashboard/main-sidebar_trans.group_invoices')}}
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSection" aria-expanded="true"
            aria-controls="collapseSection">
            <i class="fas fa-fw fa-table"></i>
            <span>{{trans('Dashboard/invoices.patient_account')}}</span>
        </a>
        <div id="collapseSection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('invoices_patient.index') }}">
                    {{trans('Dashboard/invoices.debtor_invoices')}}
                </a>
                <a class="collapse-item text-light" href="{{route('accounting.completedInvoice') }}">
                    {{trans('Dashboard/invoices.completed_invoice')}}
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseReceipt" aria-expanded="true"
            aria-controls="collapseReceipt">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{trans('Dashboard/receipt.accounts')}}</span>
        </a>
        <div id="collapseReceipt" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('Receipt.index') }}">
                    {{trans('Dashboard/receipt.catch_receipt')}}
                </a>
                <a class="collapse-item text-light" href="{{route('Payment.index') }}">
                    {{trans('Dashboard/payment.disbursement_receipt')}}
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