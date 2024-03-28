@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/doctors_trans.edit_doctor')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Doctors.index') }}">
                {{trans('Dashboard/main-sidebar_trans.doctors')}}
            </a>
            <span class="text-muted h4 mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard\doctors_trans.edit_doctor')}}
            </span>
            <span class="text-muted h5 mt-1 tx-13 mr-2 mb-0">
                / {{$doctor->name}}
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
                    <form action="{{ route('Doctors.update', 'test') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <input class="form-control" value="{{$doctor->id}}" name="id" type="hidden">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label" for="name">
                                    {{trans('Dashboard\doctors_trans.name')}}
                                </label>
                                <input value="{{$doctor->name}}" class="form-control" name="name" type="text" autofocus
                                    required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="email">
                                    {{trans('Dashboard\doctors_trans.email')}}
                                </label>
                                <input value="{{$doctor->email}}" class="form-control" name="email" type="email"
                                    required>
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
                                <input value="{{ $doctor->job_number }}" id="job_num" type="text" class="form-control"
                                    disabled readonly>
                            </div>
                        </div>

                        <div class="row row-xs align-items-center my-md-4 mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label" for="phone">
                                    {{ trans('Dashboard\doctors_trans.phone') }}
                                </label>
                                <input value="{{ $doctor->phone }}" class="form-control" name="phone" type="number"
                                    required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="section_id">
                                    {{trans('Dashboard\doctors_trans.section')}}
                                </label>
                                <select required name="section_id" class="form-select">
                                    <option value="" selected disabled>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}" {{$section->id == $doctor->section_id ? 'selected'
                                        : "" }}>
                                        {{$section->name}}</option>
                                    @endforeach
                                </select>
                                <div class=" valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="number_of_statements">
                                    {{trans('Dashboard\doctors_trans.number_of_statements')}}
                                </label>
                                <input type="number" min="0" id="number_of_statements" name="number_of_statements"
                                    class="form-control" value="{{ $doctor->number_of_statements }}" required>
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
                            @foreach (['السبت','الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة' ] as $day)
                            @php
                            $schedule = $doctor->schedules->firstWhere('day', $day);
                            @endphp
                            <div class="col-md-3 mb-4">
                                <div class="col-md-12">
                                    <div class="bg-gray-200 p-2 text-center rounded-top  m-0">
                                        <p class="text-dark m-0"> {{ $day }} </p>
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
                            @if (App::getLocale() == 'en')
                            @foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as
                            $day)
                            @php
                            $schedule = $doctor->schedules->firstWhere('day', $day);
                            @endphp
                            <div class="col-md-3 mb-4">
                                <div class="col-md-12">
                                    <div class="bg-gray-200 p-2 text-center rounded-top  m-0">
                                        <p class="text-dark m-0"> {{ $day }} </p>
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
                        <div class="row row-xs align-items-center my-md-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-6">
                                <label class="form-label" for="photo">
                                    {{ trans('Dashboard\doctors_trans.doctor_photo') }}
                                </label>
                                <input type="file" accept="image/*" name="photo" onchange="loadFile(event)"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6">
                                @if($doctor->image)
                                <img style="border-radius:20%"
                                    src="{{asset('Dashboard/img/doctors/'.$doctor->image->filename)}}" height="150px"
                                    width="150px" alt="">
                                @else
                                <img style="border-radius:50%" src="{{asset('Dashboard/img/doctor_default.png')}}"
                                    height="50px" width="50px" alt="">
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn btn-info my-3">
                            {{ trans('Dashboard\doctors_trans.edit_doctor') }}
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