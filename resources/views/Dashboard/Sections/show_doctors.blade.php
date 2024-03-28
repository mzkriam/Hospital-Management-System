@extends('Dashboard.layouts.master')
@section('title')
{{$section->name}} / {{trans('Dashboard\doctors_trans.section_doctors')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{$section->name}}
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard\doctors_trans.section_doctors')}}
            </span>
        </h1>
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
                            <th>{{trans('Dashboard\doctors_trans.section')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.appointments')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.created_at')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $doctor)
                        <tr scope="row">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($doctor->image)
                                <img style="border-radius:50%"
                                    src="{{asset('Dashboard/img/doctors/'. $doctor->image->filename)}}" height="50px"
                                    width="50px" alt="{{$doctor->name}}">
                                @else
                                <img style="rounded m-0" src="{{asset('Dashboard/img/doctor_default.png')}}"
                                    alt="doctor default image" height="50px" width="50px">

                                @endif
                            </td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->section->name}}</td>
                            <td>
                                @if ($doctor->schedules->count() > 0)
                                @foreach ($doctor->schedules->slice(0, 2) as $schedule)
                                {{ $schedule->day }}..<br>
                                @endforeach
                                @else
                                {{ trans('Dashboard\doctors_trans.no_schedules') }}
                                @endif
                            </td>
                            <td>
                                <div class="rounded border border-{{$doctor->status == 1 ? 'success' : 'danger'}}">
                                    {{$doctor->status == 1 ?
                                    trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                                </div>
                            </td>
                            <td>{{ $doctor->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans('Dashboard\doctors_trans.Processes')}}<i
                                            class="fas fa-caret-down mr-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item" href="{{route('Doctors.edit',$doctor->id)}}">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.edit_doctor')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_password{{$doctor->id}}">
                                            <i style="color: rgb(120, 234, 166)"
                                                class="fas fa-user-lock"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.update_password')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_status{{$doctor->id}}"><i
                                                style="color: rgba(255, 0, 200, 0.523)"
                                                class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.Status_change')}}
                                        </a>
                                        <a class="dropdown-item" href="{{route('doctor.showInvoices',$doctor->id) }}">
                                            <i style="color: rgb(187, 124, 229)"
                                                class="fas fa-file-invoice"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.invoices')}}
                                        </a>
                                        <a class="dropdown-item" href="{{route('doctor.reviewInvoices',$doctor->id) }}">
                                            <i style="color: rgb(86, 186, 154)" class="fas fa-calendar"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.reviews')}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{route('doctor.completedInvoices',$doctor->id) }}">
                                            <i style="color: rgb(219, 226, 120)"
                                                class="fas fa-check-circle"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/main-sidebar_trans.completed_invoices')}}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('doctor.showTreatment',$doctor->id)}}">
                                            <i style="color: rgb(81, 223, 135)" class="fas fa-medkit"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/operations.treatment')}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete{{$doctor->id}}">
                                            <i style="color: rgb(223, 81, 83)" class="fas fa-trash"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.delete_doctor')}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Dashboard.Doctors.delete')
                        @include('Dashboard.Doctors.update_password')
                        @include('Dashboard.Doctors.update_status')
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