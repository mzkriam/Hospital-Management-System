@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard\main-sidebar_trans.Patients')}}
@stop

@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard\main-sidebar_trans.Patients')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{trans('Dashboard\main-sidebar_trans.show_all')}}
            </span>
        </h1>
        @if(auth('admin')->check())
        <a href="{{ route('adminPatients.create') }}" class=" d-none d-sm-inline-block btn btn-sm btn-primary
            shadow-sm">
            <i class=" fas fa-download fa-sm text-white-50"></i>
            {{trans('Dashboard\patients.add_patient')}}
        </a>
        @else
        <a href="{{ route('Patients.create') }}" class=" d-none d-sm-inline-block btn btn-sm btn-primary
            shadow-sm">
            <i class=" fas fa-download fa-sm text-white-50"></i>
            {{trans('Dashboard\patients.add_patient')}}
        </a>
        @endif

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
                            <th>{{trans('Dashboard\patients.name')}}</th>
                            <th>{{trans('Dashboard\patients.email')}}</th>
                            <th>{{trans('Dashboard\patients.date')}}</th>
                            <th>{{trans('Dashboard\patients.phone')}}</th>
                            <th>{{trans('Dashboard\patients.gender')}}</th>
                            <th>{{trans('Dashboard\patients.blood_quarter')}}</th>
                            <th>{{trans('Dashboard\patients.address')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                            <th>{{trans('Dashboard\patients.processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Patients as $Patient)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if (auth('admin')->check())
                                <a href="{{Route('adminPatient.appointments_patient', $Patient->id)}}">
                                    {{$Patient->name}}
                                </a>
                                @else
                                <a href="{{Route('patient.appointments_patient', $Patient->id)}}">
                                    {{$Patient->name}}
                                </a>
                                @endif
                            </td>
                            <td>{{$Patient->email}}</td>
                            <td>{{$Patient->Date_Birth}}</td>
                            <td>{{$Patient->Phone}}</td>
                            <td>{{$Patient->Gender == 1 ? trans('Dashboard\patients.male') :
                                trans('Dashboard\patients.female') }}</td>
                            <td>{{$Patient->Blood_Group}}</td>
                            <td>{{$Patient->Address}}</td>
                            <td>
                                <div class=" rounded border border-{{$Patient->status == 1 ? 'success' : 'danger'}}">
                                    {{$Patient->status == 1 ?
                                    trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans('Dashboard\doctors_trans.Processes')}}<i
                                            class="fas fa-caret-down mr-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        @if(auth('admin')->check())
                                        <a class="dropdown-item" href="{{route('adminPatients.edit',$Patient->id)}}">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\patients.edit_patient')}}
                                        </a>
                                        @else
                                        <a class="dropdown-item" href="{{route('Patients.edit',$Patient->id)}}">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\patients.edit_patient')}}
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_password{{$Patient->id}}">
                                            <i style="color: rgb(234, 120, 120)"
                                                class="fas fa-user-lock"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.update_password')}} </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#update_status{{$Patient->id}}"><i
                                                style="color: rgba(0, 255, 102, 0.523)"
                                                class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.Status_change')}} </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete{{$Patient->id}}"><i style="color: rgb(223, 81, 81)"
                                                class="fas fa-trash"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\patients.delete_patient')}} </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('Dashboard.Patients.delete')
                        @include('Dashboard.Patients.update_password')
                        @include('Dashboard.Patients.update_status')
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