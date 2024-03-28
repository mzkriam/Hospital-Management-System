@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/receipt.catch_receipt')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/receipt.accounts')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/receipt.catch_receipt')}}
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
                            <th> {{trans('Dashboard/receipt.name_patient')}}</th>
                            <th>{{trans('Dashboard/receipt.price')}}</th>
                            <th>{{trans('Dashboard/receipt.description')}}</th>
                            <th> {{trans('Dashboard/receipt.date')}}</th>
                            <th>{{trans('Dashboard/receipt.process')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receipts as $receipt)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $receipt->patients->name }}</td>
                            <td>{{ number_format($receipt->amount, 2) }}</td>
                            <td>{{ \Str::limit($receipt->description, 20) }}</td>
                            <td>{{ $receipt->created_at->diffForHumans() }}</td>
                            <td>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_Receipt.edit',$receipt->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @else
                                <a href="{{route('Receipt.edit',$receipt->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-toggle="modal" href="#delete{{$receipt->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @if(auth('admin')->check())
                                <a href="{{route('admin_Receipt.show',$receipt->id)}}" class="btn btn-info btn-sm"
                                    target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                @else
                                <a href="{{route('Receipt.show',$receipt->id)}}" class="btn btn-info btn-sm"
                                    target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @include('Dashboard.Receipt.delete')
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