@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/insurance.Add_Insurance')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(auth('admin')->check())
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('adminInsurance.index') }}">
                {{trans('Dashboard/insurance.Insurance')}}
            </a>
            @else
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Insurance.index') }}">
                {{trans('Dashboard/insurance.Insurance')}}
            </a>
            @endif
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/insurance.Add_Insurance')}}
            </span>
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
                    <form action="{{route('adminInsurance.store')}}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        @else
                        <form action="{{route('Insurance.store')}}" method="post" autocomplete="off"
                            class="needs-validation" novalidate>
                            @endif
                            @csrf
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label" for="insurance_code">
                                        {{trans('Dashboard\insurance.Company_code')}}
                                    </label>
                                    <input value="{{ old('insurance_code') }}" class="form-control"
                                        name="insurance_code" type="text" autofocus required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="name">
                                        {{trans('Dashboard/insurance.Company_name')}}
                                    </label>
                                    <input value="{{ old('name') }}" class="form-control" name="name" type="text"
                                        required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="contact_number">
                                        {{trans('Dashboard/insurance.contact_number')}}
                                    </label>
                                    <input value="{{ old('contact_number') }}" class="form-control"
                                        name="contact_number" type="text" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-3 mg-b-20">
                                <div class="col-md-4">
                                    <div class="">
                                        <div class="">
                                            <label class="form-label" for="discount_percentage">
                                                {{trans('Dashboard/insurance.discount_percentage')}} %
                                            </label>
                                            <input value="{{ old('discount_percentage') }}" class="form-control"
                                                name="discount_percentage" type="number" required>
                                            <div class="valid-feedback">
                                                {{ trans('validation.good')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{ trans('validation.required_filed')}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <label class="form-label" for="company_rate">
                                            {{trans('Dashboard/insurance.Insurance_bearing_percentage')}} %
                                        </label>
                                        <input value="{{ old('company_rate') }}" class="form-control"
                                            name="company_rate" type="number" required>
                                        <div class="valid-feedback">
                                            {{ trans('validation.good')}}
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ trans('validation.required_filed')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="notes">
                                        {{trans('Dashboard/insurance.notes')}}
                                    </label>
                                    <textarea rows="5" id="notes" name="notes"
                                        class="form-control">{{old('notes')}}</textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn btn-info my-3">
                                    {{trans('Dashboard/insurance.save')}}
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