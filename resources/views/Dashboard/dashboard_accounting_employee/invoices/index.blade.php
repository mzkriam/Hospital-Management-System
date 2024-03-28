@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/invoices.patient_account')}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/invoices.invoices')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / @if($c == 0)
                {{trans('Dashboard/invoices.debtor_invoices')}}
                @else
                {{trans('Dashboard/invoices.completed_invoice')}}
                @endif
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
                            <th>{{trans("Dashboard/invoices.invoice_id")}}</th>
                            <th>{{trans("Dashboard/invoices.patient_name")}}</th>
                            <th>{{trans("Dashboard/invoices.debtor")}}</th>
                            <th>{{trans("Dashboard/invoices.creditor")}}</th>
                            <th>{{trans("Dashboard/invoices.invoice_date")}}</th>
                            @if($c == 0)
                            <th>{{trans("Dashboard/invoices.processes")}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account_patients as $account_patient)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>
                                @if($account_patient->invoice)
                                @if(auth('admin')->check())
                                <a href="{{route('admin_accounting.invoice_details',$account_patient->invoice->id)}}">
                                    {{ $account_patient->invoice->id}}
                                </a>
                                @else
                                <a href="{{route('accounting.invoice_details',$account_patient->invoice->id)}}">
                                    {{ $account_patient->invoice->id}}
                                </a>
                                @endif
                                @endif
                            </td>
                            <td>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_accounting.patient_details',$account_patient->patient_id)}}">
                                    {{$account_patient->Patient->name }}
                                </a>
                                @else
                                <a href="{{route('accounting.patient_details',$account_patient->patient_id)}}">
                                    {{$account_patient->Patient->name }}
                                </a>
                                @endif
                            </td>
                            <td>
                                {{$account_patient->total_debit }}
                            </td>
                            <td>
                                {{$account_patient->total_credit }}
                            </td>
                            <td>
                                @if($account_patient->invoice)
                                {{ $account_patient->invoice->invoice_date }}
                                @endif
                            </td>
                            @if($c == 0)
                            <td>
                                <div class="">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn ripple btn-outline-info btn-sm" type="button">
                                        @if(auth('admin')->check())
                                        <a class="text-decoration-none text-info"
                                            href="{{route('admin_ReceiptVoucher', $account_patient->invoice->id)}}">
                                            <i class=" text-warning far fa-file-alt"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_receipt")}}
                                        </a>
                                        @else
                                        <a class="text-decoration-none text-info"
                                            href="{{route('ReceiptVoucher', $account_patient->invoice->id)}}">
                                            <i class=" text-warning far fa-file-alt"></i>&nbsp;&nbsp;
                                            {{trans("Dashboard/invoices.add_a_receipt")}}
                                        </a>
                                        @endif
                                    </button>
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