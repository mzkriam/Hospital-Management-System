<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        {{trans('Dashboard/main-sidebar_trans.appointments')}}
        <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/main-sidebar_trans.internal_appointments')}}
        </span>
    </h1>
    <button wire:click="show_form_add" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        {{trans('Dashboard/appointments.add_appointment')}}
    </button>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('Dashboard/appointments.name')}}</th>
                        <th>{{trans('Dashboard/doctors_trans.section')}}</th>
                        <th>{{trans('Dashboard/appointments.doctor')}}</th>
                        <th>{{trans('Dashboard/appointments.type')}}</th>
                        <th>{{trans('Dashboard/appointments.appointment')}}</th>
                        <th>{{trans('Dashboard/doctors_trans.created_at')}}</th>
                        <th>{{trans('Dashboard/doctors_trans.Processes')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr scope="row">
                        <td>{{ $loop->iteration }}</td>
                        @if($appointment->patient)
                        <td>{{ $appointment->patient->name }}</td>
                        @endif
                        @if($appointment->section)
                        <td>{{ $appointment->section->name}}</td>
                        @endif
                        <td>
                            @if($appointment->doctor)
                            {{ $appointment->doctor->name}}
                            @else
                            Operation
                            @endif
                        </td>
                        <td>{{ $appointment->type}}</td>
                        <td>{{ $appointment->appointment}}</td>
                        <td>{{ $appointment->created_at}}</td>
                        <td>
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true"
                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">
                                    {{trans('Dashboard\doctors_trans.Processes')}}
                                    <i class="fas fa-caret-down mr-1"></i>
                                </button>
                                <div class="dropdown-menu tx-13">
                                    <a class="dropdown-item" href="#" wire:click='edit({{$appointment->id}})'>
                                        <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard\appointments.edit')}}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status"
                                        wire:click='edit_status({{$appointment->id}})'>
                                        <i style="color: rgba(0, 255, 102, 0.523)"
                                            class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard\doctors_trans.Status_change')}}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#delete_appointment" wire:click="delete({{ $appointment->id }})">
                                        <i style="color: rgba(255, 0, 0, 0.523)" class="fa fa-trash"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard\appointments.delete')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('livewire.appointments.internal.delete')
        @include('livewire.appointments.internal.update_status')
    </div>
</div>