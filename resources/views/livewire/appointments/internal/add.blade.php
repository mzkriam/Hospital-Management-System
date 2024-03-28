<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" wire:click='show_table'>
            {{trans('Dashboard/main-sidebar_trans.appointments')}}
        </a>
        <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/appointments.add_appointment')}}
        </span>
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store" autocomplete="off">
                    @csrf
                    <div class="row row-xs align-items-center mg-b-20 d-flex align-items-stretch">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="patient_id">
                                        {{trans('Dashboard/appointments.name')}}
                                    </label>
                                    <select class="form-select" wire:model="patient_id" wire:change="get_patients"
                                        id="patient_id" name="patient_id" required>
                                        <option value="" selected disabled>
                                            {{trans('Dashboard/invoices.choose_from_the_list')}}
                                        </option>
                                        @foreach($patients as $patient)
                                        <option value="{{$patient->id}}" {{old('patient_id', '' )==$patient->id ?
                                            'selected': ""}}>
                                            {{$patient->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="section_id">
                                        {{trans('Dashboard\doctors_trans.section')}}
                                    </label>
                                    <select wire:model="section_id" wire:change="get_doctors" id="section_id"
                                        name="section_id" required class="form-select">
                                        <option value="" selected disabled>
                                            {{trans('Dashboard/invoices.choose_from_the_list')}}
                                        </option>
                                        @foreach($sections as $section)
                                        <option value="{{$section->id}}" {{old('section_id')==$section->id ? 'selected':
                                            ""}}>
                                            {{$section->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="appointment" class="form-label">
                                        {{trans('Dashboard/appointments.appointment')}}
                                    </label>
                                    <input wire:model="appointment" class="form-control" type="datetime-local"
                                        id="appointment" name="appointment" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="appointment_patient">
                                        {{trans('Dashboard/appointments.appointment_patient')}}
                                    </label>
                                    <input class="form-control" name="appointment_patient" id="datetimepicker"
                                        type="text" placeholder="{{ now() }}" value="{{ now() }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="doctors" class="form-label">{{trans('Dashboard/operations.doctors')}}</label>
                            <select wire:model='selected_doctor_id' class="form-select" id="doctors" name="doctors"
                                required>
                                <option value="" selected disabled>
                                    {{trans('Dashboard/invoices.choose_from_the_list')}}
                                </option>
                                @foreach($section_doctors as $section_doctor)
                                <option value="{{$section_doctor->id}}" {{old('selected_doctor_id', ''
                                    )==$section_doctor->id ?
                                    'selected': ""}}>{{$section_doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                        <div class="col-md-12">
                            <label for="notes" class="form-label">
                                {{trans('Dashboard/appointments.notes')}}
                            </label>
                            <textarea wire:model="notes" id="notes" rows="4" name="notes" class="form-control"
                                type="text">{{ old('notes') }}</textarea>
                            <div class="valid-feedback">
                                {{ trans('validation.good')}}
                            </div>
                            <div class="invalid-feedback">
                                {{ trans('validation.required_filed')}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn btn-info my-3">
                            {{trans('Dashboard/insurance.save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>