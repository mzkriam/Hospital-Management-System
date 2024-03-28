@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/reception_employee.reception_employee')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{trans('Dashboard/reception_employee.reception_employee')}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @endsection
    @section('content')

    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.appointments')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Appointment::whereBetween('appointment',
                                [now()->addDays(-1)->startOfDay(),
                                now()->addDays(1)->startOfDay()])->count()
                                }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <livewire:appointments.internal.appointment-internal />
            </div>
        </div>
    </div>
</div>
</div>

@endsection
</body>

</html>