@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/ambulances.Ambulance")}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans("Dashboard/ambulances.Ambulance")}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans("Dashboard/ambulances.Ambulance_cars")}}
            </span>
        </h1>

        <a href="{{route('Ambulance.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50 mx-1"></i>
            {{trans("Dashboard/ambulances.add_a_new_car")}}
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
                            <th>{{trans("Dashboard/ambulances.car_number")}}</th>
                            <th>{{trans("Dashboard/ambulances.car_model")}}</th>
                            <th>{{trans("Dashboard/ambulances.year")}}</th>
                            <th>{{trans("Dashboard/ambulances.type")}}</th>
                            <th>{{trans("Dashboard/ambulances.driver_name")}}</th>
                            <th>{{trans("Dashboard/ambulances.license_number")}}</th>
                            <th>{{trans("Dashboard/ambulances.phone")}}</th>
                            <th>{{trans("Dashboard/ambulances.status")}}</th>
                            <th>{{trans("Dashboard/ambulances.notes")}}</th>
                            <th>{{trans("Dashboard/ambulances.processes")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ambulances as $ambulance)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$ambulance->car_number}}</td>
                            <td>{{$ambulance->car_model}}</td>
                            <td>{{$ambulance->car_year_made}}</td>
                            <td>{{$ambulance->car_type == 1 ? trans("Dashboard/ambulances.owned")
                                :trans("Dashboard/ambulances.rent")}}
                            </td>
                            <td>{{$ambulance->driver_name}}</td>
                            <td>{{$ambulance->driver_license_number}}</td>
                            <td>{{$ambulance->driver_phone}}</td>
                            <td class="{{($ambulance->is_available == 1 ?'bg-success':'bg-danger')}}">
                                {{$ambulance->is_available == 1 ? trans("Dashboard/ambulances.activated"):
                                trans("Dashboard/ambulances.not_activated") }}
                            </td>
                            <td>{{$ambulance->notes}}</td>
                            <td>
                                <a href="{{route('Ambulance.edit',$ambulance->id)}}" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#Deleted{{$ambulance->id}}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @include('Dashboard.Ambulance.Deleted')
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