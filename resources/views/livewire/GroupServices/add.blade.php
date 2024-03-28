<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <a class="d-none d-sm-inline-block h3 mb-0 text-gray-800 text-decoration-none" wire:click='show_form_table'>
            {{trans("Dashboard\groupServices.group_services")}}
        </a>
        <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
            @if($edit_mode)
            {{trans('Dashboard/Services.edit_Service')}}
            @else
            {{trans("Dashboard\groupServices.add_a_group_of_services")}}
            @endif
        </span>
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form class="mt-4" wire:submit.prevent="saveGroup" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label id="name_group">{{trans("Dashboard\groupServices.group_name")}}</label>
                        <input wire:model="name_group" type="text" name="name_group" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label id="notes">{{trans("Dashboard\groupServices.notes")}}</label>
                        <textarea wire:model="notes" name="notes" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="col-md-12">
                                <button class="btn btn-outline-primary" wire:click.prevent="addService">
                                    {{trans("Dashboard\groupServices.add_a_subservice")}}
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>{{trans("Dashboard\groupServices.service_name")}}</th>
                                            <th width="200">{{trans("Dashboard\groupServices.quantity")}}</th>
                                            <th width="200">{{trans("Dashboard\groupServices.processes")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($GroupsItems as $index => $groupItem)
                                        <tr>
                                            <td>
                                                @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][service_id]"
                                                    wire:model="GroupsItems.{{$index}}.service_id" />
                                                @if($groupItem['service_name'] && $groupItem['service_price'])
                                                {{ $groupItem['service_name'] }}
                                                ({{ number_format($groupItem['service_price'], 2) }})
                                                @endif
                                                @else
                                                <select name="GroupsItems[{{$index}}][service_id]"
                                                    class="form-control{{ $errors->has('GroupsItems.' . $index) ? ' is-invalid' : '' }}"
                                                    wire:model="GroupsItems.{{$index}}.service_id">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($allServices as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ \App\Models\ServiceTranslation::where(['Service_id' =>
                                                        $service->id])->pluck('name')->first() }} ({{
                                                        number_format($service->price,
                                                        2) }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('GroupsItems.' . $index))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('GroupsItems.' . $index) }}
                                                </em>
                                                @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][quantity]"
                                                    wire:model="GroupsItems.{{$index}}.quantity" />
                                                {{ $groupItem['quantity'] }}
                                                @else
                                                <input type="number" name="GroupsItems[{{$index}}][quantity]"
                                                    class="form-control" wire:model="GroupsItems.{{$index}}.quantity" />
                                                @endif
                                            </td>
                                            <td>
                                                @if($groupItem['is_saved'])
                                                <button class="btn btn-sm btn-primary"
                                                    wire:click.prevent="editService({{$index}})">
                                                    {{trans("Dashboard\groupServices.edit")}}
                                                </button>
                                                @elseif($groupItem['service_id'])
                                                <button class="btn btn-sm btn-success mr-1"
                                                    wire:click.prevent="saveService({{$index}})">
                                                    {{trans("Dashboard\groupServices.add")}}
                                                </button>
                                                @endif
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="removeService({{$index}})">{{trans("Dashboard\groupServices.delete")}}
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 ml-auto text-right">
                                <table class="table pull-right">
                                    <tr>
                                        <td style="color: red">{{trans("Dashboard\groupServices.total")}}</td>
                                        <td>{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: red">{{trans("Dashboard\groupServices.discount")}}</td>
                                        <td width="125">
                                            <input type="number" name="discount_value"
                                                class="form-control w-75 d-inline" wire:model="discount_value">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: red">{{trans("Dashboard\groupServices.tax_rate")}}</td>
                                        <td>
                                            <input type="number" name="taxes" class="form-control w-75 d-inline" min="0"
                                                max="100" wire:model="taxes"> %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: red">{{trans("Dashboard\groupServices.total_with_tax")}}</td>
                                        <td>{{ number_format($total, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <br />
                            <div>
                                <button class="btn btn-outline-success" type="submit">
                                    {{trans('Dashboard\groupServices.save')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>