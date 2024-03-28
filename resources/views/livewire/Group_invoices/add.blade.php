<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" wire:click='show_table'>
            {{trans('Dashboard/main-sidebar_trans.group_invoices')}}
        </a>
        @if($updateMode)
        <span class="text-muted h5 mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/invoices.edit_invoice')}}
        </span>
        @else
        <span class="text-muted h5 mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/invoices.add_a_new_invoice')}}
        </span>
        @endif
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>{{trans('Dashboard/invoices.patient_name')}}</label>
                            <select wire:model="patient_id" class="form-control" required>
                                <option value="">-- {{trans('Dashboard/invoices.choose_from_the_list')}} --</option>
                                @foreach($Patients as $Patient)
                                <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
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
                            <select wire:model="type" class="form-control" {{$updateMode==true ? 'disabled' :''}}>
                                <option value="">{{trans('Dashboard/invoices.choose_from_the_list') }}</option>
                                <option value="1">{{trans('Dashboard/invoices.cash')}}</option>
                                <option value="2">{{trans('Dashboard/invoices.credit')}}</option>
                            </select>
                        </div>
                    </div><br>
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
                                                        <select wire:model="Group_id" class="form-control"
                                                            wire:change="get_price" id="exampleFormControlSelect1">
                                                            <option value="">--
                                                                {{trans('Dashboard/invoices.choose_the_service')}} --
                                                            </option>
                                                            @foreach($Groups as $Group)
                                                            <option value="{{$Group->id}}">{{$Group->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input wire:model="price" type="text" class="form-control"
                                                            readonly></td>
                                                    <td><input wire:model="discount_value" type="text"
                                                            class="form-control" readonly>
                                                    </td>
                                                    <th><input wire:model="tax_rate" type="text" class="form-control"
                                                            readonly></th>
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
                    <div class="d-flex flex-row-reverse mt-3">
                        <button class="btn btn-outline-success" type="submit">
                            {{(!$updateMode) ? trans('Dashboard/invoices.add_a_new_invoice')
                            :trans('Dashboard/invoices.edit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>