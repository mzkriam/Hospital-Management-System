@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/laboratory.add_employee')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('pharmacy_employee.index') }}">
                {{trans('Dashboard\main-sidebar_trans.pharmacy')}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard\laboratory.add_employee')}}
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
                    <form action="{{ route('pharmacy_employee.store') }}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">
                                    {{trans('Dashboard/laboratory.name_employee')}}
                                </label>
                                <input value="{{ old('name') }}" id="name" type="text" name="name" class="form-control"
                                    required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="email" class="form-label">
                                    {{trans('Dashboard/doctors_trans.email')}}
                                </label>
                                <input value="{{ old('email') }}" id="email" type="email" name="email"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone" class="form-label">
                                    {{trans('Dashboard/doctors_trans.phone')}}
                                </label>
                                <input value="{{ old('phone') }}" id="phone" type="number" name="phone"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4 mb-2">
                                <label for="password" class="form-label">
                                    {{trans('Dashboard/doctors_trans.password')}}
                                </label>
                                <input value="{{ old('password') }}" id="password" type="password" name="password"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="jop_title" class="form-label">
                                    {{trans('Dashboard/laboratory.job_title')}}
                                </label>
                                <input value="{{ old('job_title') }}" id="job_title" type="text" name="job_title"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="jop_number" class="form-label">
                                    {{trans('Dashboard/laboratory.job_number')}}
                                </label>
                                <input id="jop_num" type="text" name="jop_num" class="form-control" disabled readonly
                                    placeholder="{{trans('Dashboard/laboratory.auto')}}">
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <label class="form-label mb-3">
                                {{ trans('Dashboard\doctors_trans.appointments') }}
                            </label>
                            @if (App::getLocale() == 'ar')
                            @foreach (['السبت','الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة' ]
                            as
                            $day)
                            <div class="col-md-3 mb-4">
                                <div class="col-md-12">
                                    <div class="bg-gray-200 p-2 text-center rounded-top  m-0">
                                        <p class="text-dark m-0"> {{$day}} </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-3 bg-gray-100 rounded-bottom">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <label class="text-dark form-label mb-3" for="{{ $day }}_start">
                                                    {{trans('Dashboard\doctors_trans.start_time') }}
                                                </label>
                                                <div class="">
                                                    <input class="rounded border-0" type="time" id="{{ $day }}_start"
                                                        name="schedules[{{ $day }}][start]"
                                                        value="{{old('schedules.'. $day. '.start')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3"></div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-3 text-dark" for="{{ $day }}_end">
                                                    {{ trans('Dashboard\doctors_trans.end_time') }}
                                                </label>
                                                <div class="">
                                                    <input class="rounded border-0" type="time" id="{{ $day }}_end"
                                                        name="schedules[{{ $day }}][end]"
                                                        value="{{old('schedules.'. $day. '.end')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if (App::getLocale() == 'en')
                            @foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
                            'Friday']
                            as
                            $day)
                            <div class="col-md-3 mb-4">
                                <div class="col-md-12">
                                    <div class="bg-gray-200 p-2 text-center rounded-top  m-0">
                                        <p class="text-dark m-0"> {{$day}} </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-3 bg-gray-100 rounded-bottom">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <label class="text-dark form-label mb-3" for="{{ $day }}_start">
                                                    {{trans('Dashboard\doctors_trans.start_time') }}
                                                </label>
                                                <div class="">
                                                    <input class=" rounded border-0" type="time" id="{{ $day }}_start"
                                                        name="schedules[{{ $day }}][start]"
                                                        value="{{old('schedules.'. $day. '.start')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3"></div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-3 text-dark" for="{{ $day }}_end">
                                                    {{ trans('Dashboard\doctors_trans.end_time') }}
                                                </label>
                                                <div class="">
                                                    <input class="rounded border-0" type="time" id="{{ $day }}_end"
                                                        name="schedules[{{ $day }}][end]"
                                                        value="{{old('schedules.'. $day. '.end]')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea id="description" rows="5" name="description" class="form-control"
                                    required>{{ old('description') }}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <hr class="sidebar-divider">
                        <div class="d-fex justify-content-end">

                            <button type="submit" class="btn btn-primary">
                                {{trans('Dashboard/sections_trans.save')}}
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