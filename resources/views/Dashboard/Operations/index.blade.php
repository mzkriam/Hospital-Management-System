@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/operations.operation')}}
@stop

@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/operations.operation')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{trans('Dashboard\operations.all')}}
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
                            <td>#</td>
                            <th>{{trans('Dashboard\doctors_trans.name')}}</th>
                            <th>{{trans('Dashboard\patients.name')}}</th>
                            <th>{{trans('Dashboard\operations.warnings')}}</th>
                            <th>{{trans('Dashboard\operations.procedures')}}</th>
                            <th>{{trans('Dashboard\operations.description')}}</th>
                            <th>{{trans('Dashboard\operations.created_at')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operations as $operation)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$operation->name}}</td>
                            <td>
                                @if (auth('doctor')->check())
                                <a href="{{route('patient_details',$operation->patient->id)}}">
                                    {{$operation->patient->name}}
                                </a>
                                @endif
                                @if (auth('admin')->check())
                                <a href="{{route('doctor.showPatientDoctor',$operation->patient_id)}}">
                                    {{$operation->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>{{$operation->warnings}}</td>
                            <td>{{ $operation->procedures }}</td>
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

<!-- Modal -->

@endsection
</body>

</html>