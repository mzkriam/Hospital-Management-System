@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/laboratory.ray_employee')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{trans('Dashboard/laboratory.ray_employee')}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.ray_process')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\RayService::whereDate('created_at', now()->startOfDay())->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-x-ray fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.Incomplete')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\RayService::whereDate('created_at',
                                now()->startOfDay())->where('case',0)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.complete')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\RayService::whereDate('created_at',
                                now()->startOfDay())->where('case',1)->count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap" id="example1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans("Dashboard/invoices.invoice_date")}}</th>
                            <th>{{trans("Dashboard/invoices.patient_name")}}</th>
                            <th>{{trans("Dashboard/invoices.doctors_name")}}</th>
                            <th>{{trans("Dashboard/invoices.required")}}</th>
                            <th>{{trans("Dashboard/invoices.type")}}</th>
                            @if(auth('ray_employee')->check())
                            <th>{{trans("Dashboard/invoices.processes")}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\RayService::where('case',1)->latest()->take(5)->get() as $invoice )
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_view_required',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @else
                                <a href="{{route('ray_view_required',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>{{ $invoice->doctor->name }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td>
                                <span class="badge badge-danger">
                                    {{trans("Dashboard/invoices.under_process")}}
                                </span>
                            </td>
                            @if(auth('ray_employee')->check())
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">
                                        {{trans("Dashboard/invoices.processes")}}
                                        <i class="fas fa-caret-down mr-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                            href="{{route('invoice_ray_employee.edit',$invoice->id)}}">
                                            <i class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_diagnosis")}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
</body>

</html>