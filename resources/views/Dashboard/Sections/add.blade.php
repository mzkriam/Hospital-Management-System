<div class="modal fade g-3" id="addSection" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections_trans.add_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Sections.store') }}" method="post" autocomplete="off" class="needs-validation"
                novalidate>
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name_section" class="form-label">
                                    {{trans('Dashboard/sections_trans.name_sections')}}
                                </label>
                                <input value="{{ old('name') }}" id="name_section" type="text" name="name"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="head_of_department" class="form-label">
                                    {{trans('Dashboard/sections_trans.head_of_department')}}
                                </label>
                                <select id="head_of_department" type="text" name="head_of_department"
                                    class="form-select">
                                    <option disabled selected>{{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor->name}}">
                                        {{$doctor->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="location" class="form-label">
                                    {{trans('Dashboard/sections_trans.location')}}
                                </label>
                                <input {{old('location')}} id="location" type="text" name="location"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="contact_number" class="form-label">
                                    {{trans('Dashboard/sections_trans.contact_number')}}
                                </label>
                                <input {{old('contact_number')}} id="contact_number" type="number" name="contact_number"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="description_section" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea rows="5" id="description_section" name="description" class="form-control"
                                    required>{{old('description_section')}}</textarea>
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