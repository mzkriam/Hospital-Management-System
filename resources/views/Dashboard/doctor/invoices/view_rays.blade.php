@extends('Dashboard.layouts.master')
@section('title')
{{trans("Dashboard/invoices.ray_examinations")}}
@stop
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none">
                {{trans("Dashboard/invoices.ray_examinations")}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{$rays->Patient->name}}
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
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.ray_employ_id")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$rays->RayEmployee->name}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.doctors_name")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$rays->doctor->name}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.code")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$rays->code}}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/ray_service.name")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="1">{{$rays->name}}</textarea>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center my-3 mg-b-20">
                        <div class="col-md-6">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.required")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="5">{{$rays->description}}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="description_employee" class="form-label">
                                {{trans("Dashboard/invoices.ray_notes")}}
                            </label>
                            <textarea readonly name="description_employee" class="form-control"
                                id="description_employee" rows="5">{{$rays->description_employee}}</textarea>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="demo-gallery my-4">
                            <ul id="lightgallery" class="list-unstyled row row-sm pr-0">
                                @foreach($rays->images as $image)
                                <li class="col-sm-6 col-lg-4"
                                    data-responsive="{{URL::asset('Dashboard/img/Rays/'.$image->filename)}}"
                                    data-src="{{URL::asset('Dashboard/img/Rays/'.$image->filename)}}">
                                    <a href="#">
                                        <img width="100%" height="350px" class="img-responsive"
                                            src="{{URL::asset('Dashboard/img/Rays/'.$image->filename)}}" alt="NoImg">
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