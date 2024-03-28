@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/payment.add')}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Payment.index') }}">
                {{trans('Dashboard/payment.accounts')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                    {{trans('Dashboard/payment.add')}}
                </span>
            </a>
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Payment.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-6">
                                <label class="form-label" for="patient_id">
                                    {{trans('Dashboard/payment.name_patient')}}
                                </label>
                                <select name="patient_id" class="form-select" required>
                                    <option value="" selected disabled>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    @foreach($Patients as $Patient)
                                    <option value="{{$Patient->id}}" {{ old('patient_id')==$Patient->id ? 'selected' :
                                        ""}}>{{$Patient->name}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label">
                                    {{trans('Dashboard/ray_service.price')}}
                                </label>
                                <input {{old('amount')}} id="amount" type="number" min="0" step="0.01" name="amount"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>

                        <div class="row row-xs align-items-center mg-b-20 my-3">
                            <div class="col-md-12">
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
                        <button type="submit" class="btn btn btn-info my-3">
                            {{trans('Dashboard\payment.add') }}
                        </button>
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