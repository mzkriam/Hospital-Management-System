@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/medicine.required_medications')}}
@stop

@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/medicine.required_medications')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{$treatment->patient->name}}
            </span>
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                <div class="col-md-4 mb-2">
                    <label for="patient_name" class="form-label">
                        {{trans('Dashboard\patients.name')}}
                    </label>
                    <input value="{{ $treatment->patient->name }}" id="patient_name" type="text" name="patient_name"
                        class="form-control" disabled>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="name" class="form-label">
                        {{trans('Dashboard/operations.name_treatment')}}
                    </label>
                    <input value="{{ $treatment->name }}" id="name" type="text" name="name" class="form-control"
                        disabled>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="name" class="form-label">
                        {{trans('Dashboard/operations.date')}}
                    </label>
                    <input value="{{date('Y-m-d') }}" id="name" type="text" name="name" class="form-control" disabled>
                </div>
            </div>
            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                <div class="col-md-4">
                    <label for="description" class="form-label">
                        {{trans('Dashboard/sections_trans.description')}}
                    </label>
                    <textarea id="description" rows="4" name="description" class="form-control" disabled
                        type="text">{{ $treatment->description }}</textarea>
                </div>
                <div class="col-md-4">
                    <label for="required_medications">{{trans('Dashboard/medicine.required_medications')}}</label>
                    <select multiple class="form-control" id="required_medications" name="required_medications[]"
                        disabled>
                        @foreach($medicines as $medicine)
                        <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    @if(auth('admin')->check())
                    @else
                    <form action="{{ route('add_patient_treatment_medicines', 'test') }}" method="post"
                        autocomplete="off" class="needs-validation" novalidate>
                        @endif
                        @csrf
                        <input value="{{ $treatment->patient->id }}" type="hidden" name="patient_id">
                        <input value="{{ $treatment->id }}" type="hidden" name="treatment_id">
                        <input value="{{ $treatment->invoice_id }}" type="hidden" name="invoice_id">
                        <label for="medicines">{{trans('Dashboard/operations.medicines')}}</label>
                        <select multiple class="form-control" id="medicines" name="medicines[]">
                            @foreach($medicines as $medicine)
                            <option value="{{$medicine->id}}">{{$medicine->name}}</option>
                            @endforeach
                        </select>
                        <hr class="sidebar-divider">
                        @if(auth('admin')->check())
                        @else
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{trans('Dashboard/sections_trans.save')}}
                            </button>
                        </div>
                        @endif
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
    $(document).ready(function() {
                $('#doctors').select2();
                $('#medicines').select2();
                });
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