@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/operations.edit_operation')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none"
                href="{{ route('operation.index') }}">
                {{trans('Dashboard/operations.operation')}}
            </a>
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                / {{trans('Dashboard/operations.edit_operation')}} / <span class="h6">
                    {{$operation->name}}</span>
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
                    <form action="{{ route('operation.update', 'test') }}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <input class="form-control" value="{{$operation->id}}" name="id" type="hidden">
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">
                                    {{trans('Dashboard/operations.name_operation')}}
                                </label>
                                <input value="{{$operation->name }}" id="name" type="text" name="name"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="price" class="form-label">
                                    {{trans('Dashboard/operations.price')}}
                                </label>
                                <input required value='{{$operation->price }}' id="price" type="number" name="price"
                                    min="0" step="0.01" class="form-control">
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
                                    <option value="{{$section->id}}" {{$section->id == $operation->section_id ?
                                        'selected'
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
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4">
                                <label for="doctors">{{trans('Dashboard/operations.doctors')}}</label>
                                <select multiple class="form-control" id="doctors" name="doctors[]">
                                    @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ in_array($doctor->id,
                                        $operation->doctors->pluck('id')->toArray()) ? 'selected'
                                        : '' }}>{{ $doctor->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="medicines">{{trans('Dashboard/operations.medicines')}}</label>
                                <select multiple class="form-control" id="medicines" name="medicines[]">
                                    @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" {{ in_array($medicine->id,
                                        $operation->medicines->pluck('id')->toArray()) ?
                                        'selected' : '' }}>{{ $medicine->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="description" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea id="description" rows="4" name="description" class="form-control" required
                                    type="text" price>{{ $operation->description }}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-3 mb-2">
                                <label for="procedures" class="form-label">
                                    {{trans('Dashboard/operations.procedures')}}
                                </label>
                                <textarea class="form-control" type="text" name="procedures" id="procedures"
                                    rows="5">{{$operation->procedures }}</textarea>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="warnings" class="form-label">
                                    {{trans('Dashboard/operations.warnings')}}
                                </label>
                                <textarea id="warnings" type="text" name="warnings" class="form-control"
                                    rows="5">{{$operation->warnings }}</textarea>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="side_effects" class="form-label">
                                    {{trans('Dashboard/operations.side_effects')}}
                                </label>
                                <textarea id="side_effects" type="text" name="side_effects" class="form-control"
                                    rows="5">{{$operation->side_effects }}</textarea>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="results" class="form-label">
                                    {{trans('Dashboard/operations.results')}}
                                </label>
                                <textarea id="results" type="text" name="results" rows="5"
                                    class="form-control">{{$operation->results }}</textarea>
                            </div>
                        </div>
                        <hr class="sidebar-divider">
                        <button type="submit" class="btn btn-lg btn-primary">
                            {{trans('Dashboard/sections_trans.edit')}}
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
