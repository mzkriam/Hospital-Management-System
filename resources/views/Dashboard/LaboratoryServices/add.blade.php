@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/ray_service.add_service')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('Doctors.index') }}">
                {{trans("Dashboard/invoices.examinations")}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/ray_service.add_service')}}
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
                    <form action="{{ route('laboratory_service.store') }}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">
                                    {{trans('Dashboard/ray_service.name')}}
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
                            <div class="col-md-6 mb-2">
                                <label for="laboratory_employ_id" class="form-label">
                                    {{trans('Dashboard/ray_service.lab_employ_id')}}
                                </label>
                                <select id="laboratory_employ_id" type="text" name="laboratory_employ_id"
                                    class="form-select">
                                    <option disabled selected>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    @foreach($laboratory_employees as $laboratory_employee)
                                    <option value="{{$laboratory_employee->id}}">
                                        {{$laboratory_employee->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-6 mb-2">
                                <label for="price" class="form-label">
                                    {{trans('Dashboard/ray_service.price')}}
                                </label>
                                <input {{old('price')}} id="price" type="number" min="0" step="0.01" name="price"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="code" class="form-label">
                                    {{trans('Dashboard/ray_service.code')}}
                                </label>
                                <input {{old('code')}} id="code" type="text" name="code" class="form-control">
                            </div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea row row-xs align-items-center mg-b-20s="5" id="description" name="description"
                                    class="form-control" required>{{old('description')}}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{trans('Dashboard/sections_trans.Close')}}
                </button>
                <button type="submit" class="btn btn-primary">
                    {{trans('Dashboard/sections_trans.save')}}
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@section('js')
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
