<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        {{trans('Dashboard/main-sidebar_trans.Single_service')}}
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/main-sidebar_trans.show_all')}}
        </span>
    </h1>
    <button wire:click="show_form_add" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        {{trans('Dashboard/Services.add_Service')}}
    </button>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('Dashboard\doctors_trans.name')}}</th>
                        <th>{{trans('Dashboard\doctors_trans.section')}}</th>
                        <th>{{trans('Dashboard/operations.doctors')}}</th>
                        <th>{{trans('Dashboard\doctors_trans.price')}}</th>
                        <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                        <th>{{trans('Dashboard\doctors_trans.created_at')}}</th>
                        <th>{{trans('Dashboard\doctors_trans.Processes')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr scope="row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->section->name}}</td>
                        <td>{{ $service->doctor->name}}</td>
                        <td>{{ $service->price}}</td>
                        <td>
                            <div class=" rounded border border-{{$service->status == 1 ? 'success' : 'danger'}}">
                                {{$service->status == 1 ?
                                trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                            </div>
                        </td>
                        <td>{{ $service->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true"
                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">
                                    {{trans('Dashboard\doctors_trans.Processes')}}
                                    <i class="fas fa-caret-down mr-1"></i>
                                </button>
                                <div class="dropdown-menu tx-13">
                                    <a class="dropdown-item" href="#" wire:click='edit({{$service->id}})'>
                                        <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard/Services.edit_Service')}}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status"
                                        wire:click='edit_status({{$service->id}})'>
                                        <i style="color: rgba(0, 255, 102, 0.523)"
                                            class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard\doctors_trans.Status_change')}}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_service"
                                        wire:click="delete({{ $service->id }})">
                                        <i style="color: rgba(255, 0, 0, 0.523)" class="fa fa-trash"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard\Services.delete_Service')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @include('livewire.Services.delete')
                    @include('livewire.Services.update_status')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>