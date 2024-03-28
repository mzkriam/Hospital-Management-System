@extends('Dashboard.layouts.master')

@section('title')
{{trans('Dashboard/print.print_preview')}}
@endsection
@section('content')
<div class="container-fluid">
    @section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
    @endsection
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" wire:click='show_table'>
                {{trans('Dashboard/invoices.single_service_invoices')}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
                {{trans('Dashboard/print.print_invoice')}}
            </span>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class=" main-content-body-invoice" id="print">
                        <div class="card card-invoice">
                            <div class="card-body">
                                <div class="invoice-header">
                                    <h1 class="invoice-title">
                                        {{trans('Dashboard/invoices.single_service_invoices')}}
                                    </h1>
                                    <div class="billed-from">
                                        <h6>
                                            {{trans('Dashboard/invoices.single_service_invoices')}}
                                        </h6>
                                        <p>201 المهندسين<br>
                                            Tel No: 0111111111<br>
                                            Email: Admin@gmail.com</p>
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <div class="col-md">
                                        <label
                                            class="tx-gray-600">{{trans('Dashboard/print.invoice_information')}}</label>
                                        <p class="invoice-info-row">
                                            <span>{{trans('Dashboard/invoices.service_name')}}: </span>
                                            <span>{{Request::get('Service_id')}}</span>
                                        </p>
                                        <p class="invoice-info-row">
                                            <span>{{trans('Dashboard/receipt.name_patient')}}: </span>
                                            <span>{{Request::get('patient_id')}}</span>
                                        </p>
                                        <p class="invoice-info-row"><span>{{trans('Dashboard/receipt.date')}}</span>
                                            <span>
                                                {{Request::get('invoice_date') }}
                                            </span>
                                        </p>
                                        <p class="invoice-info-row"><span>{{trans('Dashboard/print.doctor')}}</span>
                                            <span>{{ Request::get('doctor_id')}}</span>
                                        </p>
                                        <p class="invoice-info-row"><span>{{trans('Dashboard/print.section')}}</span>
                                            <span>{{ Request::get('section_id') }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="table-responsive mg-t-40">
                                    <table class="table table-invoice border text-md-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th class="wd-20p">#</th>
                                                <th class="wd-40p">{{trans('Dashboard/invoices.service_name')}}</th>
                                                <th class="tx-center">{{trans('Dashboard/invoices.service_price')}}</th>
                                                <th class="tx-right">{{trans('Dashboard/invoices.type')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="tx-12">{{ Request::get('Service_id') }}</td>
                                                <td class="tx-center">{{ Request::get('price') }}</td>
                                                <td class="tx-right">
                                                    {{Request::get('type') == 1 ?
                                                    trans('Dashboard/invoices.cash'):trans('Dashboard/invoices.credit')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="valign-middle" colspan="2" rowspan="4">
                                                    <div class="invoice-notes">
                                                        <label class="main-content-label tx-13"></label>
                                                    </div>
                                                </td>
                                                <td class="tx-right">{{trans('Dashboard/invoices.service_price')}}</td>
                                                <td class="tx-right" colspan="2"> {{number_format(Request::get('price'),
                                                    2)}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right">{{trans('Dashboard/invoices.discount_value')}}</td>
                                                <td class="tx-right" colspan="2">{{Request::get('discount_value')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right">{{trans('Dashboard/invoices.tax_rate')}}</td>
                                                <td class="tx-right" colspan="2">% {{Request::get('tax_rate')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-right tx-uppercase tx-bold tx-inverse">
                                                    {{trans('Dashboard/invoices.total_with_tax')}}
                                                </td>
                                                <td class="tx-right" colspan="2">
                                                    <h4 class="tx-primary tx-bold">
                                                        {{number_format(Request::get('total_with_tax'), 2)}}
                                                    </h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr class="mg-b-40">
                                <a href="#" class="btn btn-danger float-left mt-3 mr-2" id="print_Button"
                                    onclick="printDiv()">
                                    <i class="mdi mdi-printer ml-1"></i>{{trans('Dashboard/print.print')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
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