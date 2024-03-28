@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.laboratory_examinations")}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none">
                {{trans("Dashboard/invoices.laboratory_examinations")}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{$laboratory->Patient->name}}
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.lab_employ_id")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$laboratory->LabEmployee->name}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.doctors_name")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$laboratory->doctor->name}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.code")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$laboratory->code}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.name")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$laboratory->name}}</textarea>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center my-3 mg-b-20">
                        <div class="col-md-6">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.required")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="5">{{$laboratory->description}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.laboratory_notes")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="5">{{$laboratory->description_employee}}</textarea>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="demo-gallery mt-4">
                            <ul id="lightgallery" class="list-unstyled row row-sm pr-0">
                                @foreach($laboratory->images as $image)
                                <li class="col-sm-6 col-lg-4 p-2"
                                    data-responsive="{{URL::asset('Dashboard/img/laboratories/'.$image->filename)}}"
                                    data-src="{{URL::asset('Dashboard/img/laboratories/'.$image->filename)}}">
                                    <a href="#">
                                        <img width="100%" height="350px" class="img-responsive"
                                            src="{{URL::asset('Dashboard/img/laboratories/'.$image->filename)}}"
                                            alt="NoImg">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection

</body>

</html>