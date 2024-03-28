@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.ray')}}
@stop

@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.ray')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{trans('Dashboard\laboratory.employees')}}
            </span>
        </h1>
        <a href="{{ route('ray_employee.create') }}"" class=" d-none d-sm-inline-block btn btn-sm btn-primary
            shadow-sm">
            <i class=" fas fa-download fa-sm text-white-50"></i>
            {{trans('Dashboard\laboratory.add_employee')}}
        </a>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th>{{trans('Dashboard\doctors_trans.name')}}</th>
                            <th>{{trans('Dashboard\sections_trans.description')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.email')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.appointments')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.created_at')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ray_employees as $ray_employee)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <a href="{{ route('admin_invoice_ray_employee.index') }}">
                                    {{$ray_employee->name}}
                                </a>
                            </td>
                            <td>{{$ray_employee->description}}</td>
                            <td>{{ $ray_employee->email }}</td>
                            <td>
                                @if ($ray_employee->schedules->count() > 0)
                                @foreach ($ray_employee->schedules->slice(0, 2) as $schedule)
                                {{ $schedule->day }}..<br>
                                @endforeach
                                @else
                                {{ trans('Dashboard\doctors_trans.no_schedules') }}
                                @endif
                            </td>
                            <td>
                                <div
                                    class=" rounded border border-{{$ray_employee->status == 1 ? 'success' : 'danger'}}">
                                    {{$ray_employee->status == 1 ?
                                    trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                                </div>
                            </td>
                            <td>{{ $ray_employee->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans('Dashboard\doctors_trans.Processes')}}
                                        <i class="fas fa-caret-down mr-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                            href="{{Route('ray_employee.edit',$ray_employee->id)}}">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/laboratory.edit_employee')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_password{{$ray_employee->id}}">
                                            <i style="color: rgb(234, 120, 120)"
                                                class="fas fa-user-lock"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.update_password')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_status{{$ray_employee->id}}">
                                            <i style="color: rgba(0, 255, 102, 0.523)"
                                                class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.Status_change')}}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin_completed_ray') }}">
                                            <i style="color: rgb(207, 132, 132)"
                                                class="fas fa-file-invoice"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.completed_examinations")}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#deleteEmp{{$ray_employee->id}}">
                                            <i style="color: rgb(184, 92, 92)" class="fas fa-trash"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\sections_trans.delete')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin_ray_appointment',$ray_employee->id) }}">
                                            <i style="color: rgb(81, 180, 223)" class="fas fa-calendar"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/appointments.appointment")}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Dashboard.ray_employee.update_password')
                        @include('Dashboard.ray_employee.update_status')
                        @include('Dashboard.ray_employee.deleteEmp')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Modal -->

@endsection
</body>

</html>