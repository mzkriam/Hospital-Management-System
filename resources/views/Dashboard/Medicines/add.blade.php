<div class="modal fade g-3" id="addMedicine" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/medicine.add_medicine')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('admin_medicine.store') }}" method="post" autocomplete="off" class="needs-validation"
                novalidate>
                @else
                <form action="{{ route('medicine.store') }}" method="post" autocomplete="off" class="needs-validation"
                    novalidate>
                    @endif
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">
                                        {{trans('Dashboard/medicine.name_medicine')}}
                                    </label>
                                    <input value="{{ old('name') }}" id="name" type="text" name="name"
                                        class="form-control" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="pha_employee_id" class="form-label">
                                        {{trans('Dashboard/medicine.pha_employee_id')}}
                                    </label>
                                    <input type="text" class="form-control" name="pha_employee_id" id="pha_employee_id"
                                        value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                            <div class="row">
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
                            <div class="row">
                                <div class="col-12">
                                    <label for="description" class="form-label">
                                        {{trans('Dashboard/sections_trans.description')}}
                                    </label>
                                    <textarea rows="5" id="description" name="description" class="form-control"
                                        required>{{old('description')}}</textarea>
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