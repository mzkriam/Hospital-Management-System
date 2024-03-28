@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.patient_medical_record")}}
@stop
@section('css')
<style>
    .timeline-centered {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-centered.timeline-sm .timeline-entry {
        margin-bottom: 20px !important;
    }

    .timeline-centered.timeline-sm .timeline-entry .timeline-entry-inner .timeline-label {
        padding: 1em;
    }

    .timeline-centered:before,
    .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 7px;
        background: #ffffff;
        left: 50%;
        top: 20px;
        bottom: 20px;
        margin-left: -4px;
    }

    .timeline-centered .timeline-entry {
        position: relative;
        width: 50%;
        float: right;
        margin-bottom: 70px;
        clear: both;
    }

    .timeline-centered .timeline-entry:before,
    .timeline-centered .timeline-entry:after {
        content: " ";
        display: table;
    }

    .timeline-centered .timeline-entry:after {
        clear: both;
    }

    .timeline-centered .timeline-entry.begin {
        margin-bottom: 0;
    }

    .timeline-centered .timeline-entry.left-aligned {
        float: left;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
        margin-left: 0;
        margin-right: -28px;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
        left: auto;
        right: -200px;
        text-align: left;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time>span {
        display: block;
        font-size: 30px;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
        float: right;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
        margin-left: 0;
        margin-right: 85px;
    }

    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
        left: auto;
        right: 0;
        margin-left: 0;
        margin-right: -9px;
        -moz-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .timeline-centered .timeline-entry .timeline-entry-inner {
        position: relative;
        margin-left: -31px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner:before,
    .timeline-centered .timeline-entry .timeline-entry-inner:after {
        content: " ";
        display: table;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner:after {
        clear: both;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
        position: absolute;
        left: -130px;
        text-align: right;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time>span {
        display: block;
        font-size: 30px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time>span:first-child {
        font-size: 18px;
        font-weight: bold;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time>span:last-child {
        font-size: 12px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
        background: #fff;
        color: #999999;
        display: block;
        width: 60px;
        height: 60px;
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding-box;
        background-clip: padding-box;
        border-radius: 50%;
        text-align: center;
        border: 7px solid #ffffff;
        line-height: 45px;
        font-size: 15px;
        float: left;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
        background-color: #dc6767;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
        background-color: #5cb85c;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
        background-color: #5bc0de;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
        background-color: #f0ad4e;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
        background-color: #d9534f;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-red {
        background-color: #bf4346;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-green {
        background-color: #488c6c;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-blue {
        background-color: #0a819c;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-yellow {
        background-color: #f2994b;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-orange {
        background-color: #e9662c;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-pink {
        background-color: #bf3773;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-violet {
        background-color: #9351ad;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-grey {
        background-color: #4b5d67;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-dark {
        background-color: #594857;
        color: #fff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
        position: relative;
        background: #ffffff;
        padding: 1.7em;
        margin-left: 85px;
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red {
        background: #bf4346;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red:after {
        border-color: transparent #bf4346 transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-red p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green {
        background: #488c6c;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green:after {
        border-color: transparent #488c6c transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-green p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange {
        background: #e9662c;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange:after {
        border-color: transparent #e9662c transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-orange p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow {
        background: #f2994b;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow:after {
        border-color: transparent #f2994b transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-yellow p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue {
        background: #0a819c;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue:after {
        border-color: transparent #0a819c transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-blue p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink {
        background: #bf3773;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink:after {
        border-color: transparent #bf3773 transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-pink p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet {
        background: #9351ad;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet:after {
        border-color: transparent #9351ad transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-violet p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey {
        background: #4b5d67;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey:after {
        border-color: transparent #4b5d67 transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-grey p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark {
        background: #594857;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark:after {
        border-color: transparent #594857 transparent transparent;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label.bg-dark p {
        color: #ffffff;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
        content: '';
        display: block;
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 9px 9px 9px 0;
        border-color: transparent #ffffff transparent transparent;
        left: 0;
        top: 20px;
        margin-left: -9px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title,
    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
        color: #999999;
        margin: 0;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p+p {
        margin-top: 15px;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title {
        margin-bottom: 10px;
        font-family: 'Oswald';
        font-weight: bold;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label .timeline-title span {
        -webkit-opacity: .6;
        -moz-opacity: .6;
        opacity: .6;
        -ms-filter: alpha(opacity=60);
        filter: alpha(opacity=60);
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p .timeline-img {
        margin: 5px 10px 0 0;
    }

    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p .timeline-img.pull-right {
        margin: 5px 0 0 10px;
    }
</style>
@endsection

@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="text-decoration-none text-dark" href="#">
                {{trans("Dashboard/invoices.patient_medical_record")}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{$patient->name}}
            </span>
        </h1>
    </div>
    @endsection

    @section('content')
    @include('Dashboard.messages_alert')
    <div class="card shadow mb-4">
        <div class="card-body bg-light">
            <div class="row mb-3">
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.name')}} : </label>
                    <label class="form-label  text-center">{{$patient->name}}</label>
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.email')}} : </label>
                    <label class="form-label  text-center">{{$patient->email}}</label>
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.date')}} : </label>
                    <label class="form-label  text-center">{{$patient->Date_Birth}}</label>
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.phone')}} : </label>
                    <label class="form-label  text-center">{{$patient->Phone}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.gender')}} :
                    </label>
                    <label class="form-label  text-center">{{$patient->Gender == 1 ?
                        trans('Dashboard\patients.male') :
                        trans('Dashboard\patients.female') }}</label>
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.blood_quarter')}} :
                    </label>
                    <label class="form-label  text-center">{{$patient->Blood_Group}}</label>
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.insurance')}} :
                    </label>
                    @if($patient->insurance)
                    <label class="form-label  text-center">{{$patient->insurance->name}}</label>
                    @endif
                </div>
                <div class="col-3">
                    <label class="form-label text-dark text-center">{{trans('Dashboard\patients.created_at')}} :
                    </label>
                    <label class="form-label  text-center">{{$patient->created_at}}</label>
                </div>
            </div>
        </div>
    </div>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="panel panel-primary tabs-style-1">
        <div class="tab-menu-heading">
            <div class="tabs-menu1">
                <ul class="nav panel-tabs main-nav-line bg-gradient-secondary"
                    style="display: flex; justify-content: center;">
                    <li class="nav-item">
                        <a href="#tab1" class="nav-link active text-decoration-none text-light"
                            data-toggle="tab">{{trans("Dashboard/invoices.patient_medical_record")}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" class="nav-link text-decoration-none text-light" data-toggle="tab">
                            {{trans("Dashboard/invoices.X-rays")}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab3" class="nav-link text-decoration-none text-light" data-toggle="tab">
                            {{trans("Dashboard/invoices.Laboratory")}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane mt-3 active" id="tab1">
                <br>
                <div class="container bootstrap snippets bootdeys">
                    <div class="col-md-9">
                        <div class="timeline-centered timeline-sm">
                            @foreach($patient_records as $patient_record)
                            <article class="timeline-entry">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time">
                                        <span>{{$patient_record->date}}</span>
                                        <span>By: {{$patient_record->doctor->name}}</span>
                                    </time>
                                    <div class="timeline-icon bg-dark"></div>
                                    <div class="timeline-label bg-dark">
                                        <h4 class="timeline-title">Treatment</h4>
                                        <h5 style="color: #ddd">{{$patient_record->name}}</h5>
                                        <hr style="color: #fff">
                                        <h5 style="color: #ddd">The descriptions:</h5>
                                        <h6 style="color: #ddd">{{$patient_record->description}}</h6>
                                        <hr style="color: #fff">
                                        <h5 style="color: #ddd">The Medicines:</h5>
                                        @foreach($patient_record->Medicines as $medicine)
                                        @if(isset($medicine->name))
                                        <h6 style="color: #ddd">
                                            {{ $medicine->name }}
                                        </h6>
                                        @endif
                                        @endforeach
                                        <hr style="color: #fff">
                                        <h5 style="color: #ddd">Side effects:</h5>
                                        <h6 style="color: #ddd">{{$patient_record->side_effects}}</h6>
                                        <hr style="color: #fff">
                                        <h5 style="color: #ddd">Warnings:</h5>
                                        <h6 style="color: #ddd">{{$patient_record->warnings}}</h6>
                                        <hr style="color: #fff">
                                        <h5 style="color: #ddd">Procedures:</h5>
                                        <h6 style="color: #ddd">{{$patient_record->procedures}}</h6>
                                        <hr style="color: #fff">
                                        <h4 style="color: #ddd">The results:</h4>
                                        <h6 style="color: #ddd">{{$patient_record->results}}</h6>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                            @foreach($patient_operations as $patient_operation)
                            <article class="timeline-entry left-aligned">
                                <div class="timeline-entry-inner">
                                    <time class="timeline-time">
                                        <span>{{$patient_operation->created_at}}</span>
                                        <span>By: {{$patient_operation->doctor->name}}</span>
                                    </time>
                                    <div class="timeline-icon bg-green"></div>
                                    <div class="timeline-label bg-green">
                                        <h4 class="timeline-title">
                                            Operation
                                        </h4>
                                        <h5 class="text-light">{{$patient_operation->name}}</h5>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">The doctors:</h5>
                                        @foreach($patient_operation->doctors as $doctor)
                                        @if(isset($doctor->name))
                                        <h6 class="text-light">
                                            {{ $doctor->name }}
                                        </h6>
                                        @endif
                                        @endforeach
                                        <hr style="color: #fff">
                                        <h5 class="text-light">The Medicines:</h5>
                                        @foreach($patient_operation->Medicines as $medicine)
                                        @if(isset($medicine->name))
                                        <h6 class="text-light">
                                            {{ $medicine->name }}
                                        </h6>
                                        @endif
                                        @endforeach
                                        <hr style="color: #fff">
                                        <h5 class="text-light">Descriptions:</h5>
                                        <p>{{$patient_operation->description}}</p>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">Side effects:</h5>
                                        <p>{{$patient_operation->side_effects}}</p>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">Warnings:</h5>
                                        <p>{{$patient_operation->warnings}}</p>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">Procedures:</h5>
                                        <p>{{$patient_operation->procedures}}</p>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">The results:</h5>
                                        <p>{{$patient_operation->results}}</p>
                                        <hr style="color: #fff">
                                        <h5 class="text-light">Appointment:</h5>
                                        <p>{{$patient_operation->appointment}}</p>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                            {{-- <article class="timeline-entry">
                                <div class="timeline-entry-inner">
                                    <time datetime="2014-01-09T13:22" class="timeline-time"><span>8:20
                                            PM</span><span>04/03/2013</span></time>
                                    <div class="timeline-icon bg-orange"><i class="fa fa-paper-plane"></i></div>
                                    <div class="timeline-label bg-orange">
                                        <h4 class="timeline-title">Daily Feeds</h4>

                                        <p><img src="https://www.bootdey.com/image/45x45/" alt=""
                                                class="timeline-img pull-left">Parsley
                                            amaranth tigernut silver beet maize fennel spinach ricebean black-eyed.
                                            Tolerably
                                            earnestly
                                            middleton extremely distrusts she boy now not. Add and offered prepare how
                                            cordial.
                                        </p>
                                    </div>
                                </div>
                                <div class="timeline-entry-inner">
                                    <div style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);"
                                        class="timeline-icon"><i class="fa fa-plus"></i></div>
                                </div>
                            </article> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="table-responsive">
                    <table class="table table-hover text-md-nowrap text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans("Dashboard/invoices.required")}}</th>
                                <th>{{trans("Dashboard/invoices.doctors_name")}}</th>
                                <th>{{trans("Dashboard/ray_service.ray_employ_id")}}</th>
                                <th>{{trans("Dashboard/invoices.type")}}</th>
                                <th>{{trans("Dashboard/invoices.processes")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient_rays as $patient_ray)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$patient_ray->description}}</td>
                                <td>{{$patient_ray->doctor->name}}</td>
                                <td>{{$patient_ray->employee->name}}</td>
                                @if($patient_ray->case == 0)
                                <td class="text-danger">{{trans("Dashboard/invoices.not_complete")}}</td>
                                @else
                                <td class="text-success">{{trans("Dashboard/invoices.complete")}}</td>
                                @endif
                                @if($patient_ray->case == 0)
                                <td>
                                    <span class="badge badge-danger">
                                        {{trans("Dashboard/invoices.under_process")}}
                                    </span>
                                </td>
                                @else
                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="{{route('doctor.showRay',$patient_ray->id)}}">
                                        <i class="fas fa-binoculars"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @include('Dashboard.doctor.invoices.edit_xray_conversion')
                            @include('Dashboard.doctor.invoices.deleted')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <div class="table-responsive">
                    <table class="table table-hover text-md-nowrap text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans("Dashboard/invoices.required")}}</th>
                                <th>{{trans("Dashboard/invoices.doctors_name")}}</th>
                                <th>{{trans("Dashboard/ray_service.lab_employ_id")}}</th>
                                <th>{{trans("Dashboard/invoices.type")}}</th>
                                <th>{{trans("Dashboard/invoices.processes")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient_Laboratories as $patient_Laboratorie)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$patient_Laboratorie->description}}</td>
                                <td>{{$patient_Laboratorie->doctor->name}}</td>
                                <td>{{$patient_Laboratorie->employee->name}}</td>
                                @if($patient_Laboratorie->case == 0)
                                <td class="text-danger">{{trans("Dashboard/invoices.not_complete")}}</td>
                                @else
                                <td class="text-success">{{trans("Dashboard/invoices.complete")}}</td>
                                @endif
                                @if($patient_Laboratorie->case == 0)
                                <td>
                                    <span class="badge badge-danger">
                                        {{trans("Dashboard/invoices.under_process")}}
                                    </span>
                                </td>
                                @else
                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="{{route('doctor.showLaboratory',$patient_Laboratorie->id)}}">
                                        <i class="fas fa-binoculars"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
</body>

</html>