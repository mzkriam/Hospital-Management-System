@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.medical_examinations")}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/invoices.examinations')}}
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
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans("Dashboard/invoices.invoice_date")}}</th>
                            <th>{{trans("Dashboard/invoices.service_name")}}</th>
                            <th>{{trans("Dashboard/invoices.patient_name")}}</th>
                            <th>{{trans("Dashboard/invoices.type")}}</th>
                            @if (auth('doctor')->check())
                            <th>{{trans("Dashboard/invoices.processes")}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->Service->name ?? $invoice->Group->name }}</td>
                            <td>
                                @if (auth('doctor')->check())
                                <a href="{{route('patient_details',$invoice->id)}}">
                                    {{$invoice->Patient->name }}
                                </a>
                                @endif
                                @if (auth('admin')->check())
                                <a href="{{route('doctor.showPatientDoctor',$invoice->patient_id)}}">
                                    {{$invoice->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                                @if($invoice->invoice_status == 1)
                                <span class="badge badge-danger">
                                    {{trans("Dashboard/invoices.under_process")}}
                                </span>
                                @elseif($invoice->invoice_status == 2)
                                <span class="badge badge-warning">
                                    {{trans("Dashboard/invoices.medical_reviews")}}
                                </span>
                                @else
                                <span class="badge badge-success">
                                    {{trans("Dashboard/invoices.completed_medical_examinations")}}
                                </span>
                                @endif
                            </td>
                            @if (auth('doctor')->check())
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                        type="button">{{trans("Dashboard/invoices.processes")}}
                                        <i class="fas fa-caret-down mr-1"></i>
                                    </button>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item" href="{{route('treatment.add', $invoice->id)}}">
                                            <i class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_diagnosis")}}
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{route('treatment.add_a_review', $invoice->id)}}"><i
                                                class="text-warning far fa-file-alt"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_review")}}
                                        </a>
                                        <a class="dropdown-item" href="{{route('doctor.addOperation', $invoice->id)}}">
                                            <i class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_operation")}}
                                        </a>
                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#xray_conversion{{$invoice->id}}"><i
                                                class="text-primary fas fa-x-ray"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.transfer_to_ray")}}
                                        </a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#laboratorie_conversion{{$invoice->id}}"><i
                                                class="text-warning fas fa-syringe"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.transfer_to_laboratory")}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @include('Dashboard.Doctor.invoices.xray_conversion')
                        @include('Dashboard.Doctor.invoices.Laboratorie_conversion')
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