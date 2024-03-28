@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/print.print_preview')}}
@stop
@section('css')
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
</style>
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(auth('admin')->check())
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('admin_Receipt.index') }}">
                {{trans('Dashboard/receipt.catch_receipt')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{trans('Dashboard/print.print_invoice')}}
                </span>
            </a>
            @else
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Receipt.index') }}">
                {{trans('Dashboard/receipt.catch_receipt')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{trans('Dashboard/print.print_invoice')}}
                </span>
            </a>
            @endif
        </h1>
    </div>
    @endsection
    @section('content')
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{trans('Dashboard/receipt.catch_receipt')}}</h1>
                            <div class="billed-from">
                                <h6>برنامج ادراه المستشفي </h6>
                                <p>201 المهندسين<br>
                                    Tel No: 011111111<br>
                                    Email: Hospital@gmail.com</p>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">{{trans('Dashboard/print.invoice_information')}}</label>
                                <p class="invoice-info-row"><span>{{trans('Dashboard/receipt.date')}} : </span>
                                    <span>{{$receipt->date}}</span>
                                </p>
                                <p class="invoice-info-row "><span>{{trans('Dashboard/receipt.name_patient')}} : </span>
                                    <span>{{$receipt->patients->name}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">{{trans('Dashboard/receipt.description')}}</th>
                                        <th class="tx-center">{{trans('Dashboard/receipt.price')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ $receipt->description}}</td>
                                        <td class="tx-center">{{ number_format($receipt->amount,2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>{{trans('Dashboard/print.print')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script src="{{URL::asset('Admin/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script type="text/javascript">
    function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
</script>
@endsection