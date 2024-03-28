<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" wire:click='show_table'>
            {{trans('Dashboard/main-sidebar_trans.Single_service')}}
        </a>
        <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
            @if($update_mode)
            {{trans('Dashboard/Services.edit_Service')}}
            @else
            {{trans('Dashboard/Services.add_Service')}}
            @endif
        </span>
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store_single" autocomplete="off">
                    @csrf
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                            <label class="form-label" for="name">
                                {{trans('Dashboard\doctors_trans.name')}}
                            </label>
                            <input wire:model="name" class="form-control" name="name" type="text" autofocus required>
                            <div class="valid-feedback">
                                {{ trans('validation.good')}}
                            </div>
                            <div class="invalid-feedback">
                                {{ trans('validation.required_filed')}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">
                                {{trans('Dashboard/ray_service.price')}}
                            </label>
                            <input wire:model="price" id="price" type="number" min="0" step="0.01" name="price"
                                class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="section_id">
                                {{trans('Dashboard\doctors_trans.section')}}
                            </label>
                            <select wire:model="section_id" wire:change="get_doctors" required name="section_id"
                                class="form-select">
                                <option value="" selected disabled>
                                    {{trans('Dashboard/invoices.choose_from_the_list')}}
                                </option>
                                @foreach($sections as $section)
                                <option value="{{$section->id}}" {{old('section_id')==$section->id ? 'selected': ""}}>
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
                        <div class="col-md-3">
                            <label class="form-label" for="doctors">{{trans('Dashboard/operations.doctors')}}</label>
                            <select wire:model='doctor_id' class="form-select" id="doctors" name="doctor_id">
                                <option value="" selected disabled>
                                    {{trans('Dashboard/invoices.choose_from_the_list')}}
                                </option>
                                @foreach($section_doctors as $section_doctor)
                                <option value="{{$section_doctor->id}}">{{$section_doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                        <div class="col-md-12">
                            <label for="description" class="form-label">
                                {{trans('Dashboard/sections_trans.description')}}
                            </label>
                            <textarea wire:model='description' id="description" rows="4" name="description"
                                class="form-control" required type="text">{{ old('description') }}</textarea>
                            <div class="valid-feedback">
                                {{ trans('validation.good')}}
                            </div>
                            <div class="invalid-feedback">
                                {{ trans('validation.required_filed')}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        @if($update_mode)
                        <button type="submit" class="btn btn btn-info my-3">
                            {{trans('Dashboard/Services.edit_Service')}}
                        </button>
                        @else
                        <button type="submit" class="btn btn btn-info my-3">
                            {{trans('Dashboard/Services.add_Service')}}
                        </button>
                        @endif
                    </div>
                    <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch">
                        {{-- <div class="col-md-4">
                            <label for="medicines">{{trans('Dashboard/operations.medicines')}}</label>
                            <select wire:model='selected_medicine_id' multiple class="form-control" id="medicines"
                                name="medicines[]">
                                @foreach($medicines as $medicine)
                                <option value="{{$medicine['id']}}">{{$medicine['name']}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- <div class="col-md-4">
                            <label for="operations">{{trans('Dashboard/operations.operation')}}</label>
                            <select wire:model='selected_operation_id' multiple class="form-control" id="operations"
                                name="section_operations[]">
                                @foreach($section_operations as $section_operation)
                                <option value="{{$section_operation->id}}">{{$section_operation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="treatments">{{trans('Dashboard/operations.treatment')}}</label>
                            <select wire:model='selected_treatment_id' wire:change='get_medicines' multiple
                                class="form-control" id="treatments" name="section_treatments[]">
                                @foreach($section_treatments as $section_treatment)
                                <option value="{{$section_treatment->id}}">{{$section_treatment->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}

                    </div>
                    {{-- <div class="row row-xs align-items-center my-4 mg-b-20 d-flex align-items-stretch"> --}}
                        {{-- <div class="col">
                            <label>{{trans('Dashboard/invoices.doctors_name')}}</label>
                            <select wire:model="doctor_id" wire:change="get_section" class="form-control"
                                id="exampleFormControlSelect1" required>
                                <option value="">-- {{trans('Dashboard/invoices.choose_from_the_list')}} --</option>
                                @foreach($Doctors as $Doctor)
                                <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>{{trans('Dashboard/invoices.section')}}</label>
                            <input wire:model="section_id" type="text" class="form-control" readonly>
                        </div>
                        <div class="col">
                            <label>{{trans('Dashboard/invoices.type')}}</label>
                            <select wire:model="type" class="form-control" {{$updateMode==true ? "disabled" : "" }}>
                                <option value="">-- {{trans('Dashboard/invoices.choose_from_the_list') }}--</option>
                                <option value="1">{{trans('Dashboard/invoices.cash')}}</option>
                                <option value="2">{{trans('Dashboard/invoices.credit')}}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-0"></h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped mg-b-0 text-md-nowrap"
                                            style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{trans('Dashboard/invoices.service_name')}}</th>
                                                    <th>{{trans('Dashboard/invoices.service_price')}}</th>
                                                    <th>{{trans('Dashboard/invoices.discount_value')}}</th>
                                                    <th>{{trans('Dashboard/invoices.tax_rate')}}</th>
                                                    <th>{{trans('Dashboard/invoices.tax_value')}}</th>
                                                    <th>{{trans('Dashboard/invoices.total_with_tax')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>
                                                        <select wire:model="Service_id" wire:change="get_price"
                                                            class="form-control" id="exampleFormControlSelect1">
                                                            <option value="">--
                                                                {{trans('Dashboard/invoices.choose_the_service')}}
                                                                --
                                                            </option>
                                                            @foreach($Services as $Service)
                                                            <option value="{{$Service->id}}">{{$Service->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input wire:model="price" type="text" class="form-control"
                                                            readonly>
                                                    </td>
                                                    <td><input wire:model="discount_value" type="text"
                                                            class="form-control">
                                                    </td>
                                                    <th><input wire:model="tax_rate" type="text" class="form-control">
                                                    </th>
                                                    <td><input type="text" class="form-control" value="{{$tax_value}}"
                                                            readonly>
                                                    </td>
                                                    <td><input type="text" class="form-control" readonly
                                                            value="{{$subtotal + $tax_value }}"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-success" type="submit">{{(!$updateMode) ?
                        trans('Dashboard/invoices.add_a_new_invoice') :trans('Dashboard/invoices.edit') }}</button>
                    --}}
                </form>
            </div>
        </div>
    </div>
</div>