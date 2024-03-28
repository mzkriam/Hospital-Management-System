@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/receipt.add')}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(auth('admin')->check())
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('admin_Receipt.index') }}">
                {{trans('Dashboard/receipt.accounts')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{trans('Dashboard/receipt.add')}}
                </span>
            </a>
            @else
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Receipt.index') }}">
                {{trans('Dashboard/receipt.accounts')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{trans('Dashboard/receipt.add')}}
                </span>
            </a>
            @endif
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(auth('admin')->check())
                    <form action="{{ route('admin_Receipt.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @else
                        <form action="{{ route('Receipt.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @endif
                            {{ csrf_field() }}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label" for="invoice_id">
                                        {{trans('Dashboard/invoices.invoice_number')}}
                                    </label>
                                    <input type="hidden" type="number" name="invoice_id"
                                        value="{{$account_patients->invoice_id}}">
                                    <input class="form-control" type="text" name="invoice_id" id="invoice_id" disabled
                                        value="{{$account_patients->invoice_id}}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="patient_name">
                                        {{trans('Dashboard/payment.name_patient')}}
                                    </label>
                                    <input type="hidden" name="patient_id" value="{{$account_patients->Patient->id}}">
                                    <input class="form-control" type="text" name="patient_name" id="patient_name"
                                        disabled value="{{$account_patients->Patient->name}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="total_debit" class="form-label">
                                        {{trans('Dashboard/invoices.total_debit')}}
                                    </label>
                                    <input class="form-control" id="total_debit" type="text" name="total_debit" disabled
                                        value="{{$account_patients->total_debit}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-3 mg-b-20 d-flex flex-row-reverse">
                                <div class="col-md-4">
                                    <label class="form-label" for="total_credit">
                                        {{trans('Dashboard/invoices.total_credit')}}
                                    </label>
                                    <input class="form-control" type="text" name="total_credit" id="total_credit"
                                        disabled value="{{$account_patients->total_credit}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-3 mg-b-20 d-flex flex-row-reverse">
                                <div class="col-md-4">
                                    <label class="form-label" for="debit">
                                        {{trans('Dashboard/invoices.total_debit')}}
                                    </label>
                                    <input class="form-control" type="text" name="debit" id="debit" disabled
                                        value="{{$account_patients->total_debit - $account_patients->total_credit}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center MY-3 mg-b-20 d-flex flex-row-reverse">
                                <div class="col-md-4">
                                    <label for="receipt_id" class="form-label">
                                        {{trans('Dashboard/invoices.new_credit')}}
                                    </label>
                                    <input value="{{old('amount')}}" id="amount" type="number" min="0"
                                        max="{{$account_patients->total_debit - $account_patients->total_credit}}"
                                        step="0.01" name="amount" class="form-control" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20 my-3 d-flex flex-row-reverse">
                                <div class="col-md-4">
                                    <label class="form-label" for="description">
                                        {{trans('Dashboard/payment.description')}}
                                    </label>
                                    <textarea class="form-control" name="description" required
                                        rows="3">{{old('description')}}</textarea>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn btn-info my-3">
                                    {{trans('Dashboard\payment.add') }}
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
@section('js')
<script>
    var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
    form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
    event.preventDefault()
    event.stopPropagation()
    }

    form.classList.add('was-validated')
    }, false)
    })
    })()
</script>
@endsection
</body>

</html>