@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.medical_examinations")}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans("Dashboard/invoices.examinations")}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans("Dashboard/invoices.medical_examinations")}}
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
                            @if(auth('laboratory_employee')->check())
                            <th>{{trans("Dashboard/invoices.processes")}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_viewRequired',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @else
                                <a href="{{route('lab_view_required',$invoice->id)}}">
                                    {{ $invoice->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>{{ $invoice->doctor->name }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td>
                                <span class="badge badge-danger">
                                    {{trans("Dashboard/invoices.under_process")}}
                                </span>
                            </td>
                            @if(auth('laboratory_employee')->check())
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans("Dashboard/invoices.processes")}}<i
                                            class="fas fa-caret-down mr-1"></i></button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item"
                                            href="{{route('invoices_laboratory_employee.edit',$invoice->id)}}"><i
                                                class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_diagnosis")}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            @endif
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