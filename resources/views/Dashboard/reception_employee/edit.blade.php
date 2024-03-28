@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/reception_employee.edit_employee')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('reception_employee.index') }}">
                {{trans('Dashboard/reception_employee.reception')}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard\reception_employee.edit_employee')}} / <span class="h6">
                    {{$reception_employee->name}}</span>
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
                    <form action="{{ route('reception_employee.update', 'test') }}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <input class="form-control" value="{{$reception_employee->id}}" name="id" type="hidden">
                        <div class="container-fluid">
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">
                                        {{trans('Dashboard/laboratory.name_employee')}}
                                    </label>
                                    <input value="{{ $reception_employee->name }}" id="name" type="text" name="name"
                                        class="form-control" required>
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
                                    <input value="{{ $reception_employee->email }}" id="email" type="email" name="email"
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
                                    <input value="{{ $reception_employee->phone }}" id="phone" type="number"
                                        name="phone" class="form-control" required>
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
                                    <label for="job_title" class="form-label">
                                        {{trans('Dashboard/laboratory.job_title')}}
                                    </label>
                                    <input value="{{ $reception_employee->job_title }}" id="job_title" type="text"
                                        name="job_title" class="form-control" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="job_num" class="form-label">
                                        {{trans('Dashboard/laboratory.job_number')}}
                                    </label>
                                    <input value="{{ $reception_employee->job_number }}" id="job_num" type="text"
                                        class="form-control" disabled readonly>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="password" class="form-label">
                                        {{trans('Dashboard/doctors_trans.password')}}
                                    </label>
                                    <input id="password" type="password" class="form-control" readonly disabled>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
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
                                @php
                                $schedule = $reception_employee->schedules->firstWhere('day', $day);
                                @endphp

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
                                                        <input class="rounded border-0" type="time"
                                                            id="{{ $day }}_start" name="schedules[{{ $day }}][start]"
                                                            value="{{ $schedule->start_time ?? '' }}">
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
                                                            value="{{$schedules->end_time ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="checkbox" id="{{ $day }}_cancel"
                                                    name="schedules[{{ $day }}][cancel]">
                                                <label for="{{ $day }}_cancel">{{
                                                    trans('Dashboard\doctors_trans.cancel_day') }}</label>
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
                                @php
                                $schedule = $reception_employee->schedules->firstWhere('day', $day);
                                @endphp
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
                                                        <input class=" rounded border-0" type="time"
                                                            id="{{ $day }}_start" name="schedules[{{ $day }}][start]"
                                                            value="{{ $schedule->start_time ?? '' }}">
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
                                                            value="{{ $schedule->end_time ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="checkbox" id="{{ $day }}_cancel"
                                                    name="schedules[{{ $day }}][cancel]">
                                                <label for="{{ $day }}_cancel">{{
                                                    trans('Dashboard\doctors_trans.cancel_day') }}</label>
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
                                        required>{{ $reception_employee->description }}</textarea>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{trans('Dashboard/sections_trans.edit')}}
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