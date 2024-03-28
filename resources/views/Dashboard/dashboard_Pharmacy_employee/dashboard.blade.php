@extends('Dashboard.layouts.master')
@section('title')
{{trans('Auth/login.pharmacy_employee')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{trans('Auth/login.pharmacy_employee')}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.medicines')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{\App\Models\Medicine::count()}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{trans('Dashboard/dashboard.added_medications_today')}}
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{\App\Models\Medicine::whereDate('created_at',
                                        now()->startOfDay())->count()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>{{trans('Dashboard\doctors_trans.name')}}</th>
                                <th>{{trans('Dashboard\patients.name')}}</th>
                                <th>{{trans('Dashboard\operations.description')}}</th>
                                <th>{{trans('Dashboard\operations.created_at')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Operation::whereDate('created_at',
                            now()->startOfDay())->where('status_medicine',
                            0)->whereHas('Medicines')->latest()->take(5)->get() as
                            $operation)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$operation->name}}</td>
                                <td>
                                    @if (auth('pharmacy_employee')->check())
                                    <a href="{{route('patient_operation_medicines',$operation->id)}}">
                                        {{$operation->patient->name}}
                                    </a>
                                    @endif
                                    @if (auth('admin')->check())
                                    <a href="{{route('admin_patient_operation_medicines',$operation->id)}}">
                                        {{$operation->patient->name}}
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $operation->description }}</td>
                                <td>{{ $operation->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
</body>

</html>