@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/payment.disbursement_receipt')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/payment.accounts')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/payment.disbursement_receipt')}}
            </span>
        </h1>
        <a href="{{route('Payment.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50 mx-1"></i>
            {{trans('Dashboard/payment.add')}}
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
                            <th>{{trans('Dashboard/payment.name_patient')}}</th>
                            <th>{{trans('Dashboard/payment.price')}}</th>
                            <th>{{trans('Dashboard/payment.description')}}</th>
                            <th>{{trans('Dashboard/payment.date')}}</th>
                            <th>{{trans('Dashboard/payment.process')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $payment->patients->name }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ \Str::limit($payment->description, 50) }}</td>
                            <td>{{ $payment->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{route('Payment.edit',$payment->id)}}" class="btn btn-sm btn-primary"><i
                                        title="{{trans('Dashboard/payment.edit')}}" class="fas fa-edit"></i></a>
                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    title="{{trans('Dashboard/doctors_trans.delete')}}" data-toggle="modal"
                                    href="#delete{{$payment->id}}">
                                    <i class="fas fa-trash"></i></a>
                                <a href="{{route('Payment.show',$payment->id)}}" class="btn btn-info btn-sm"
                                    target="_blank" title="{{trans('Dashboard/print.print_invoice')}}">
                                    <i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                        @include('Dashboard.Payment.delete')
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