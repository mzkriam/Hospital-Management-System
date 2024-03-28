@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.Insurance')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.Insurance')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/main-sidebar_trans.show_all')}}
            </span>
        </h1>
        @if(auth('admin')->check())
        <a href="{{route('adminInsurance.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50 mx-1"></i>
            {{trans('Dashboard/insurance.Add_Insurance')}}
        </a>
        @else
        <a href="{{route('Insurance.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50 mx-1"></i>
            {{trans('Dashboard/insurance.Add_Insurance')}}
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
                            <th>{{trans('Dashboard/insurance.Company_code')}}</th>
                            <th>{{trans('Dashboard/insurance.Company_name')}}</th>
                            <th>{{trans('Dashboard/insurance.contact_number')}}</th>
                            <th>{{trans('Dashboard/insurance.discount_percentage')}}</th>
                            <th>{{trans('Dashboard/insurance.Insurance_bearing_percentage')}}</th>
                            <th>{{trans('Dashboard/insurance.status')}}</th>
                            <th>{{trans('Dashboard/insurance.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insurances as $insurance)
                        <tr>
                            <td>{{$loop->iteration }}</td>
                            <td>{{$insurance->insurance_code}}</td>
                            <td>{{$insurance->name}}</td>
                            <td>{{$insurance->contact_number}}</td>
                            <td>{{$insurance->discount_percentage}}</td>
                            <td>{{$insurance->company_rate}}</td>
                            <td>
                                <div class="rounded border border-{{$insurance->status == 1 ? 'success':'danger'}}">
                                    {{$insurance->status == 1 ? trans('Dashboard/doctors_trans.Enabled')
                                    :
                                    trans('Dashboard/doctors_trans.Not_enabled') }}
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">
                                        {{trans('Dashboard\doctors_trans.Processes')}}
                                        <i class="fas fa-caret-down mr-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        @if(auth('admin')->check())
                                        <a href="{{route('adminInsurance.edit',$insurance->id)}}" class="dropdown-item">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/insurance.edit_Insurance')}}
                                        </a>
                                        @else
                                        <a href="{{route('Insurance.edit',$insurance->id)}}" class="dropdown-item">
                                            <i style="color: #0ba360" class="fas fa-sync"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard/insurance.edit_Insurance')}}
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="#update_status{{$insurance->id}}"
                                            data-effect="effect-scale" data-toggle="modal">
                                            <i style="color: rgba(0, 255, 102, 0.523)"
                                                class="fas fa-ethernet"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\doctors_trans.Status_change')}} </a>
                                        </a>
                                        <a class="dropdown-item" data-effect="effect-scale" data-toggle="modal"
                                            data-target="#Deleted{{$insurance->id}}">
                                            <i style="color: rgb(223, 81, 81)" class="fas fa-trash"></i>&nbsp;&nbsp;
                                            {{trans('Dashboard\insurance.delete')}} </a>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            @include('Dashboard.insurance.Delete')
                            @include('Dashboard.insurance.update_status')
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