@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/dashboard.unlock')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" href="#">
                {{trans('Dashboard/dashboard.unlock')}}
            </a>
        </h1>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(\Session::has('danger'))
                    <div class="alert alert-danger">
                        {{\Session::get('danger')}}
                    </div>
                    @else
                    <div class="alert alert-warning" role="alert">
                        {{trans('Dashboard/dashboard.access')}}
                    </div>
                    @endif
                    <form action="{{ route('check.password') }}" method="post" autocomplete="off"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <input type="password" class="form-control rounded" name="password"
                                    placeholder="Enter the Password" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-4">
                                <input type="text" readonly class="form-control border-0" id="staticEmail2"
                                    value="{{auth()->user()->email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="my-4 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary mb-3">Submit</button>
                            </div>
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