<div>
    @if($message === true)
    <script>
        alert('تم ارسال تفاصيل الحجز الي المستشفي وسيتم ارسال معلومات الموعد عبر الهاتف والبريد الالكتروني')
            location.reload()
    </script>
    @endif
    @if($message2 === true)
    <script>
        alert('لا توجد مواعيد لهذا اليوم برجاء اختيار يوم اخر')
            location.reload()
    </script>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store" autocomplete="off">
                        @csrf
                        {{-- <div class="row row-xs align-items-center mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="patient_id">
                                            {{trans('Dashboard/appointments.name')}}
                                        </label>
                                        <select class="form-select" wire:model="patient_id" id="patient_id"
                                            name="patient_id" required>
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
                                            <option value="{{$section->id}}" {{old('section_id')==$section->id ?
                                                'selected':
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
                                <label for="doctors"
                                    class="form-label">{{trans('Dashboard/operations.doctors')}}</label>
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
                        </div> --}}
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4">
                                <label class="form-label" for="name">
                                    {{trans('Dashboard\appointments.name')}}
                                </label>
                                <input wire:model="name" class="form-control" name="name" type="text" autofocus
                                    required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="Gender">
                                    {{trans('Dashboard\patients.gender')}}
                                </label>
                                <select wire:model="Gender" class="form-select" name="Gender" required>
                                    <option value="" selected disabled>--
                                        {{trans('Dashboard\patients.choose')}} --</option>
                                    <option value="1">{{trans('Dashboard\patients.male')}}</option>
                                    <option value="2">{{trans('Dashboard\patients.female')}}</option>
                                </select>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"
                                    for="birth_patient">{{trans('Dashboard\patients.date')}}</label>
                                <input wire:model="birth_patient" class="form-control fc-datepicker"
                                    name="birth_patient" placeholder="YYYY-MM-DD" type="text" required
                                    value="{{old('birth_patient')}}">
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4">
                                <label class="form-label" for="Blood_Group">
                                    {{trans('Dashboard\patients.blood_quarter')}}
                                </label>
                                <select wire:model="Blood_Group" class="form-select" name="Blood_Group" required>
                                    <option value="" selected disabled>--
                                        {{trans('Dashboard\patients.choose')}} --</option>
                                    <option value="O-">O-</option>
                                    <option value="O+">O+</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="insurance_id">
                                    {{trans('Dashboard\patients.insurance')}}
                                </label>
                                <select wire:model="insurance_id" name="insurance_id" class="form-select">
                                    <option value="" selected disabled>
                                        {{trans('Dashboard/invoices.choose_from_the_list')}}
                                    </option>
                                    @foreach($insurances as $insurance)
                                    <option value="{{$insurance->id}}" {{old('insurance_id')==$insurance->id ?
                                        'selected':
                                        ""}}>{{$insurance->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="Address" class="form-label">
                                    {{trans('Dashboard/appointments.address')}}
                                </label>
                                <input wire:model="Address" id="Address" type="text" name="Address" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-4">
                                <label class="form-label" for="email">
                                    {{trans('Dashboard\doctors_trans.email')}}
                                </label>
                                <input wire:model="email" value="{{ old('email') }}" class="form-control" name="email"
                                    type="email" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="phone">
                                    {{ trans('Dashboard\doctors_trans.phone') }}
                                </label>
                                <input wire:model="phone" value="{{ old('phone') }}" class="form-control" name="phone"
                                    type="number" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="appointment_patient">
                                    {{trans('Dashboard/appointments.appointment_patient')}}
                                </label>
                                <input wire:model="appointment_patient" class="form-control" name="appointment_patient"
                                    id="datetimepicker" type="text" placeholder="{{ now() }}" value="{{ now() }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                            <div class="col-md-12">
                                <label for="notes" class="form-label">
                                    {{trans('Dashboard/appointments.notes')}}
                                </label>
                                <textarea wire:model="notes" id="notes" rows="4" name="notes" class="form-control"
                                    required type="text">{{ old('notes') }}</textarea>
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
</div>