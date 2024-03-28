@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.medicine')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.medicine')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
                {{trans('Dashboard/main-sidebar_trans.show_all')}}
            </span>
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addMedicine ">
            <i class=" fas fa-download fa-sm text-white-50"></i>
            {{trans('Dashboard/medicine.add_medicine')}}
        </a>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th>{{trans('Dashboard/medicine.name_medicine')}}</th>
                            <th>{{trans('Dashboard/ray_service.price')}}</th>
                            <th>{{trans('Dashboard/medicine.pha_employee_id')}}</th>
                            <th>{{trans('Dashboard\doctors_trans.status')}}</th>
                            <th>{{trans('Dashboard/sections_trans.description')}}</th>
                            <th>{{trans('Dashboard/sections_trans.created_at')}}</th>
                            <th>{{trans('Dashboard/sections_trans.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicines as $medicine)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$medicine->name}}</td>
                            <td>{{$medicine->price}}</td>
                            <td>{{$medicine->PhaEmployee ? $medicine->PhaEmployee->name : "No Employee"}}</td>
                            <td>
                                <div class=" rounded border border-{{$medicine->status == 0 ? 'success' : 'danger'}}">
                                    {{$medicine->status == 0 ?
                                    trans('Dashboard\doctors_trans.Enabled'):trans('Dashboard\doctors_trans.Not_enabled')}}
                                </div>
                            </td>
                            <td>{{$medicine->description}}</td>
                            <td>{{$medicine->created_at->diffForHumans()}}</td>
                            <td>
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                    data-toggle="modal" href="#edit{{$medicine->id}}">
                                    <span class="fas fa-user"></span>
                                </a>
                                <a class="modal-effect btn btn-sm btn-success" href="#update_status{{$medicine->id}}"
                                    data-effect="effect-scale" data-toggle="modal">
                                    <i class="fas fa-ethernet"></i>

                                </a>
                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-toggle="modal" href="#delete{{$medicine->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @include('Dashboard.Medicines.edit')
                        @include('Dashboard.Medicines.delete')
                        @include('Dashboard.Medicines.update_status')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('Dashboard.Medicines.add')
</div>
</div>

<!-- Modal -->

@endsection
</body>

</html>
