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
                    <div class="container">
                        <div class="p-5">
                            <h2 class="section-title headline-md text-center" data-reveal="bottom">
                                {{trans('Dashboard/appointments.make_appointment')}}</h2>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form wire:submit.prevent="store" autocomplete="off">
                            @csrf
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="name">
                                        {{trans('Dashboard\appointments.name')}}
                                    </label>
                                    <input wire:model="name" value="{{old('name')}}"
                                        class="input-field title-md border border-1 rounded px-3 form-control" id="name"
                                        name="name" type="text" autofocus required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="Gender">
                                        {{trans('Dashboard\patients.gender')}}
                                    </label>
                                    <select wire:model="gender"
                                        class="form-select input-field title-md border border-1 rounded px-3"
                                        name="Gender" id="Gender" required>
                                        <option value="" selected disabled>
                                            {{trans('Dashboard\patients.choose')}}
                                        </option>
                                        <option value="male" {{old('Gender')=="male" ? "selected" : "" }}>
                                            {{trans('Dashboard\patients.male')}}</option>
                                        <option value="female" {{old('Gender')=="female" ? "selected" : "" }}>
                                            {{trans('Dashboard\patients.female')}}</option>
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="birth_patient">
                                        {{trans('Dashboard\patients.date')}}
                                    </label>
                                    <input wire:model="birth_patient"
                                        class="input-field title-md border border-1 rounded px-3 form-control"
                                        name="birth_patient" placeholder="YYYY-MM-DD" type="text" required
                                        value="{{old('birth_patient')}}" id="birth_patient">
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="Blood_Group">
                                        {{trans('Dashboard\patients.blood_quarter')}}
                                    </label>
                                    <select wire:model="Blood_Group" id="Blood_Group"
                                        class="input-field title-md border border-1 rounded px-3 form-select"
                                        name="Blood_Group" required>
                                        <option value="" selected disabled>
                                            {{trans('Dashboard\patients.choose')}} </option>
                                        <option value="O-" {{old('Blood_Group')=="O-" ? "selected" : "" }}>O-</option>
                                        <option value="O+" {{old('Blood_Group')=="O+" ? "selected" : "" }}>O+</option>
                                        <option value="A+" {{old('Blood_Group')=="A+" ? "selected" : "" }}>A+</option>
                                        <option value="A-" {{old('Blood_Group')=="A-" ? "selected" : "" }}>A-</option>
                                        <option value="B+" {{old('Blood_Group')=="B+" ? "selected" : "" }}>B+</option>
                                        <option value="B-" {{old('Blood_Group')=="B-" ? "selected" : "" }}>B-</option>
                                        <option value="AB+" {{old('Blood_Group')=="AB+" ? "selected" : "" }}>AB+
                                        </option>
                                        <option value="AB-" {{old('Blood_Group')=="AB-" ? "selected" : "" }}>AB-
                                        </option>
                                    </select>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="insurance_id">
                                        {{trans('Dashboard\patients.insurance')}}
                                    </label>
                                    <select wire:model="insurance_id" name="insurance_id" id="insurance_id"
                                        class="input-field title-md border border-1 rounded px-3 form-select">
                                        <option value="" selected disabled>
                                            {{trans('Dashboard/invoices.choose_from_the_list')}}
                                        </option>
                                        @foreach($insurances as $insurance)
                                        <option value="{{$insurance->id}}" {{old('insurance_id')==$insurance->id ?
                                            'selected':
                                            ""}}>{{$insurance->name}}</option>
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
                                    <label for="Address" class="form-label text-muted">
                                        {{trans('Dashboard/appointments.address')}}
                                    </label>
                                    <input wire:model="Address" id="Address" type="text" name="Address"
                                        value="{{old('Address')}}"
                                        class="input-field title-md border border-1 rounded px-3 form-control" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="email">
                                        {{trans('Dashboard\doctors_trans.email')}}
                                    </label>
                                    <input wire:model="email" value="{{ old('email') }}"
                                        class="input-field title-md border border-1 rounded px-3 form-control"
                                        name="email" id="email" type="email" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="phone">
                                        {{ trans('Dashboard\doctors_trans.phone') }}
                                    </label>
                                    <input wire:model="phone" value="{{ old('phone') }}"
                                        class="input-field title-md border border-1 rounded px-3 form-control"
                                        name="phone" id="phone" type="number" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-6">
                                    <label class="form-label text-muted" for="section_id">
                                        {{trans('Dashboard\doctors_trans.section')}}
                                    </label>
                                    <select wire:model="section_id" wire:change="get_doctors" id="section_id"
                                        name="section_id" required
                                        class="input-field title-md border border-1 rounded px-3 form-select">
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
                                <div class="col-md-6">
                                    <label for="doctors" class="form-label text-muted">
                                        {{trans('Dashboard/operations.doctors')}}
                                    </label>
                                    <select wire:model='selected_doctor_id'
                                        class="input-field title-md border border-1 rounded px-3 form-select"
                                        id="doctors" name="doctors" required>
                                        <option value="" selected disabled>
                                            {{trans('Dashboard/invoices.choose_from_the_list')}}
                                        </option>
                                        @foreach($section_doctors as $section_doctor)
                                        <option value="{{$section_doctor->id}}" {{old('selected_doctor_id', ''
                                            )==$section_doctor->id ?
                                            'selected': ""}}>{{$section_doctor->name}}</option>
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
                            <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                                <div class="col-md-12">
                                    <label for="notes" class="form-label text-muted">
                                        {{trans('Dashboard/appointments.notes')}}
                                    </label>
                                    <textarea wire:model="notes" id="notes" rows="4" name="notes"
                                        class="input-field title-md border border-1 rounded px-3 form-control" required
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
                                <button type="submit" class="my-3 btn has-before title-md">
                                    {{trans('Dashboard/insurance.save')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>