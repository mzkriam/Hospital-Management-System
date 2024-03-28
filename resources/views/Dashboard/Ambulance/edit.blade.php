@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/ambulances.edit_car")}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Ambulance.index') }}">
                {{trans("Dashboard/ambulances.Ambulance")}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans("Dashboard/ambulances.edit_car")}}
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
                    <form action="{{route('Ambulance.update','test')}}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$ambulance->id}}">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label" for="car_number">
                                    {{trans("Dashboard/ambulances.car_number")}}
                                </label>
                                <input type="number" name="car_number" value="{{$ambulance->car_number}}"
                                    class="form-control" id="car_number" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="car_model">
                                    {{trans("Dashboard/ambulances.car_model")}}
                                </label>
                                <input type="text" name="car_model" value="{{$ambulance->car_model}}"
                                    class="form-control" id="car_model" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="car_year_made">
                                    {{trans("Dashboard/ambulances.year")}}
                                </label>
                                <input type="date" name="car_year_made" value="{{$ambulance->car_year_made}}"
                                    class="form-control" id="car_year_made" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="car_type">
                                    {{trans("Dashboard/ambulances.type")}}
                                </label>
                                <select class="form-select" id="car_type" name="car_type" required>
                                    <option value="" selected disabled>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    <option value="1" {{ $ambulance->car_type == "1" ? 'selected' : "" }}>
                                        {{trans("Dashboard/ambulances.owned")}}
                                    </option>
                                    <option value="2" {{ $ambulance->car_type == "2" ? 'selected' : "" }}>
                                        {{trans("Dashboard/ambulances.rent")}}
                                    </option>
                                </select>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-3">
                                <label class="form-label" for="driver_name">
                                    {{trans("Dashboard/ambulances.driver_name")}}
                                </label>
                                <input type="text" name="driver_name" value="{{$ambulance->driver_name}}"
                                    class="form-control" id="driver_name" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="driver_license_number">
                                    {{trans("Dashboard/ambulances.license_number")}}
                                </label>
                                <input type="number" id="driver_license_number" name="driver_license_number"
                                    value="{{$ambulance->driver_license_number}}" class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="driver_phone">
                                    {{trans("Dashboard/ambulances.phone")}}
                                </label>
                                <input type="number" name="driver_phone" value="{{$ambulance->driver_phone}}"
                                    class="form-control" id="driver_phone" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="is_available">
                                    {{trans("Dashboard/ambulances.status")}}
                                </label>
                                <select class="form-select" id="is_available" name="is_available" required>
                                    <option value="" selected disabled>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    <option value="1" {{ $ambulance->is_available == "1" ? 'selected' : "" }}>
                                        {{ trans("Dashboard/ambulances.activated")}}
                                    </option>
                                    <option value="0" {{ $ambulance->is_available == "0" ? 'selected' : "" }}>
                                        {{trans("Dashboard/ambulances.not_activated")}}
                                    </option>
                                </select>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-12">
                                <label class="form-label" for="notes">{{trans("Dashboard/ambulances.notes")}}</label>
                                <textarea rows="5" cols="10" class="form-control" name="notes" id="notes"
                                    required>{{$ambulance->notes}}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn btn-info my-3">
                            {{trans("Dashboard/ambulances.edit_car")}}
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