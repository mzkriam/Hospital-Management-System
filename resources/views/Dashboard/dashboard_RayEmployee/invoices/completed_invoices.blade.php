@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.completed_medical_examinations")}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans("Dashboard/invoices.examinations")}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans("Dashboard/invoices.completed_medical_examinations")}}
            </span>
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap" id="example1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans("Dashboard/invoices.invoice_date")}}</th>
                            <th>{{trans("Dashboard/invoices.patient_name")}}</th>
                            <th>{{trans("Dashboard/invoices.doctors_name")}}</th>
                            <th>{{trans("Dashboard/invoices.required")}}</th>
                            <th>{{trans("Dashboard/invoices.type")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_view_ray',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @else
                                <a href="{{route('view_ray',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>{{ $invoice->doctor->name }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td>
                                <span class="badge badge-success">
                                    {{trans("Dashboard/invoices.completed_medical_examinations")}}
                                </span>
                            </td>
                        </tr>
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