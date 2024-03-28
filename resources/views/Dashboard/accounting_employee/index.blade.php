@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.accounting_employee')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.accounting_employee')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/main-sidebar_trans.show_all')}}
            </span>
        </h1>

        <a href="{{route('accounting_employee.create')}}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50 mx-1"></i>
            {{trans('Dashboard/main-sidebar_trans.add_accounting_employee')}}
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
                            <th>#</th>
                            <th>{{trans('Dashboard\doctors_trans.doctor_photo')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.name')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.email')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.appointments')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.created_at')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounting_employees as $accounting_employee)
                        <tr scope="row">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($accounting_employee->image)
                                <img style="border-radius:50%"
                                    src="{{asset('Dashboard/img/accounting_employee/'. $accounting_employee->image->filename)}}"
                                    height="50px" width="50px" alt="{{$accounting_employee->name}}">
                                @else
                                <img style="rounded m-0" src="{{asset('Dashboard/img/doctor_default.png')}}"
                                    alt="doctor default image" height="50px" width="50px">
                                @endif
                            </td>
                            <td>{{ $accounting_employee->name }}</td>
                            <td>{{ $accounting_employee->email }}</td>
                            <td>
                                @if ($accounting_employee->schedules->count() > 0)
                                @foreach ($accounting_employee->schedules->slice(0, 2) as $schedule)
                                {{ $schedule->day }}..<br>
                                @endforeach
                                @else
                                {{ trans('Dashboard\doctors_trans.no_schedules') }}
                                @endif
                            </td>
                            <td>
                                <div
                                    class="rounded border border-{{$accounting_employee->status == 1 ? 'success' : 'danger'}}">
                                    {{$accounting_employee->status == 1 ?
                                    trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                                </div>
                            </td>
                            <td>{{ $accounting_employee->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans('Dashboard\doctors_trans.Processes')}}
                                        <i class="fas fa-caret-down mr-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                            href="{{route('accounting_employee.edit',$accounting_employee->id)}}">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.edit_accounting_employee')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_password{{$accounting_employee->id}}">
                                            <i style="color: rgb(120, 234, 166)"
                                                class="fas fa-user-lock"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.update_password')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_status{{$accounting_employee->id}}"><i
                                                style="color: rgba(255, 0, 200, 0.523)"
                                                class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.Status_change')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{route('accounting_employee.showInvoices',$accounting_employee->id) }}">
                                            <i style="color: rgb(187, 124, 229)"
                                                class="fas fa-file-invoice"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.invoices')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{route('accounting_employee.reviewInvoices',$accounting_employee->id) }}">
                                            <i style="color: rgb(86, 186, 154)" class="fas fa-calendar"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.reviews')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{route('accounting_employee.completedInvoices',$accounting_employee->id) }}">
                                            <i style="color: rgb(219, 226, 120)"
                                                class="fas fa-check-circle"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.completed_invoices')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('accounting_employee.showTreatment',$accounting_employee->id)}}">
                                            <i style="color: rgb(81, 223, 135)" class="fas fa-medkit"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/operations.treatment')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete{{$accounting_employee->id}}">
                                            <i style="color: rgb(223, 81, 83)" class="fas fa-trash"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.delete_doctor')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('admin_acc_appointment', $accounting_employee->id) }}">
                                            <i style="color: rgb(81, 180, 223)" class="fas fa-calendar"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/appointments.appointment")}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Dashboard.accounting_employee.delete')
                        @include('Dashboard.accounting_employee.update_password')
                        @include('Dashboard.accounting_employee.update_status')
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