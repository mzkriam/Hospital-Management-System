@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard\patients.add_patient')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(auth('admin')->check())
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('adminPatients.index') }}">
                {{trans('Dashboard\patients.patients')}}
            </a>
            @else
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Patients.index') }}">
                {{trans('Dashboard\patients.patients')}}
            </a>
            @endif
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard\patients.add_patient')}}
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
                    <form action="{{route('adminPatients.store')}}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        @else
                        <form action="{{route('Patients.store')}}" method="post" autocomplete="off"
                            class="needs-validation" novalidate>
                            @endif
                            @csrf
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">
                                        {{trans('Dashboard\patients.name')}}
                                    </label>
                                    <input value="{{ old('name') }}" class="form-control" name="name" type="text"
                                        autofocus required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="Gender">
                                        {{trans('Dashboard\patients.gender')}}
                                    </label>
                                    <select class="form-select" name="Gender" required>
                                        <option value="" selected disabled>
                                            {{trans('Dashboard\patients.choose')}}
                                        </option>
                                        <option value="1" {{old('Gender')=='1' ? 'selected' : "" }}>
                                            {{trans('Dashboard\patients.male')}}
                                        </option>
                                        <option value="2" {{old('Gender')=='2' ? 'selected' : "" }}>
                                            {{trans('Dashboard\patients.female')}}</option>
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"
                                        for="Date_Birth">{{trans('Dashboard\patients.date')}}</label>
                                    <input class="form-control fc-datepicker" name="Date_Birth" placeholder="YYYY-MM-DD"
                                        type="text" required value="{{old('Date_Birth')}}">
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20 my-3">
                                <div class="col-md-4">
                                    <label class="form-label"
                                        for="Blood_Group">{{trans('Dashboard\patients.blood_quarter')}}</label>
                                    <select class="form-select" name="Blood_Group" required>
                                        <option value="" selected disabled>--
                                            {{trans('Dashboard\patients.choose')}} --</option>
                                        <option value="O-" {{old('Blood_Group')=="O-" ? "selected" : "" }}>O-</option>
                                        <option value="O+" {{old('Blood_Group')=="O+" ? "selected" : "" }}>O+</option>
                                        <option value="A+" {{old('Blood_Group')=="A+" ? "selected" : "" }}>A+</option>
                                        <option value="A-" {{old('Blood_Group')=="A-" ? "selected" : "" }}>A-</option>
                                        <option value="B+" {{old('Blood_Group')=="B+" ? "selected" : "" }}>B+</option>
                                        <option value="B-" {{old('Blood_Group')=="B-" ? "selected" : "" }}>B-</option>
                                        <option value="AB+" {{old('Blood_Group')=="AB+" ? "selected" : "" }}>AB+
                                        </option>
                                        <option value="AB-" {{old('Blood_Group')=="AB-" ? "selected" : "" }}>AB-
                                        </option>
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="insurance_id">
                                        {{trans('Dashboard\patients.insurance')}}
                                    </label>
                                    <select name="insurance_id" class="form-select">
                                        <option value="" selected disabled>
                                            {{trans('Dashboard/invoices.choose_from_the_list')}}
                                        </option>
                                        @foreach($insurances as $insurance)
                                        <option value="{{$insurance->id}}" {{old('insurance_id')==$insurance->id ?
                                            'selected':
                                            ""}}>{{$insurance->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="Address">
                                        {{trans('Dashboard\patients.address')}}
                                    </label>
                                    <input value="{{ old('Address') }}" class="form-control" id="Address" name="Address"
                                        type="text" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label" for="email">
                                        {{trans('Dashboard\doctors_trans.email')}}
                                    </label>
                                    <input value="{{ old('email') }}" class="form-control" name="email" type="email"
                                        required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="Phone">
                                        {{ trans('Dashboard\doctors_trans.phone') }}
                                    </label>
                                    <input value="{{ old('Phone') }}" class="form-control" name="Phone" type="number"
                                        required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="password">
                                        {{ trans('Dashboard\doctors_trans.password') }}
                                    </label>
                                    <input class="form-control" name="password" type="password" required>
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
                                    {{trans('Dashboard\patients.add_patient')}}
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