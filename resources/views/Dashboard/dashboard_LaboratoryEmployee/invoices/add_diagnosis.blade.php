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
                    <form action="{{route('invoices_laboratory_employee.update',$invoice->id)}}" method="post"
                        autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="laboratory_employ_id" class="form-label">
                                    {{trans('Dashboard/ray_service.lab_employ_id')}}
                                </label>
                                <input class="form-control" type="text" name="laboratory_employ_id"
                                    id="laboratory_employ_id" readonly value="{{auth()->user()->name}}">
                            </div>
                            <div class="col-md-3 mb-2">
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
                            <div class="col-md-3 mb-2">
                                <label for="price" class="form-label">
                                    {{trans('Dashboard/ray_service.price')}}
                                </label>
                                <input value="{{old('price')}}" id="price" type="number" name="price"
                                    class="form-control" required min="0" step="0.01" class="form-control">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="code" class="form-label">
                                    {{trans('Dashboard/ray_service.code')}}
                                </label>
                                <input {{old('code')}} id="code" type="text" name="code" class="form-control">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <label for="description_employee" class="form-label">
                                    {{ trans('Dashboard\invoices.diagnosis')}}
                                </label>
                                <textarea class="form-control" id="description_employee" name="description_employee"
                                    rows="3" required>{{old('description_employee')}}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="form-label">{{ trans('Dashboard\invoices.attachments')}}</label>
                            <input id="photo" class="form-control" type="file" name="photos[]" accept="image/*" multiple
                                required>
                            <div class="valid-feedback">
                                {{ trans('validation.good')}}
                            </div>
                            <div class="invalid-feedback">
                                {{ trans('validation.required_filed')}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn btn-info my-3">
                            {{ trans('Dashboard\sections_trans.save')}}
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