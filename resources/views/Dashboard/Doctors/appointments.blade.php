@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/appointments.appointment')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/appointments.appointment')}} /
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                {{$doctor->name}}
            </span>
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
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
                                        <input disabled class=" rounded border-0" type="time" id="{{ $day }}_start"
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
                                        <input disabled class="rounded border-0" type="time" id="{{ $day }}_end"
                                            name="schedules[{{ $day }}][end]" value="{{ $schedule->end_time ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @if (App::getLocale() == 'en')
            <div class="row">
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
                                        <input disabled class=" rounded border-0" type="time" id="{{ $day }}_start"
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
                                        <input disabled class="rounded border-0" type="time" id="{{ $day }}_end"
                                            name="schedules[{{ $day }}][end]" value="{{ $schedule->end_time ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>



</div>



@endsection
</body>

</html>