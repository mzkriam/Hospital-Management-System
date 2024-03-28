<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        {{trans('Dashboard/main-sidebar_trans.group_invoices')}}
        <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/main-sidebar_trans.group_invoices')}}
        </span>
    </h1>
    <button wire:click="show_form_add" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        {{trans('Dashboard/invoices.add_a_new_invoice')}}
    </button>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('Dashboard/invoices.service_name')}}</th>
                        <th>{{trans('Dashboard/invoices.patient_name')}}</th>
                        <th>{{trans('Dashboard/invoices.invoice_date')}}</th>
                        <th>{{trans('Dashboard/invoices.doctors_name')}}</th>
                        <th>{{trans('Dashboard/invoices.section')}}</th>
                        <th>{{trans('Dashboard/invoices.service_price')}}</th>
                        <th>{{trans('Dashboard/invoices.discount_value')}}</th>

                        <th>{{trans('Dashboard/invoices.total_with_tax')}}</th>
                        <th>{{trans('Dashboard/invoices.type')}}</th>
                        <th>{{trans('Dashboard/invoices.processes')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group_invoices as $group_invoice)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $group_invoice->Group->name }}</td>
                        <td>{{ $group_invoice->Patient->name }}</td>
                        <td>{{ $group_invoice->invoice_date }}</td>
                        <td>{{ $group_invoice->Doctor->name }}</td>
                        <td>{{ $group_invoice->Section->name }}</td>
                        <td>{{ number_format($group_invoice->price, 2) }}</td>
                        <td>{{ number_format($group_invoice->discount_value, 2) }}</td>
                        <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>
                        <td>{{ $group_invoice->type == 1 ? trans('Dashboard/invoices.cash')
                            :trans('Dashboard/invoices.credit')}}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true"
                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">
                                    {{trans('Dashboard\doctors_trans.Processes')}}
                                    <i class="fas fa-caret-down mr-1"></i>
                                </button>
                                <div class="dropdown-menu tx-13">
                                    <a class="dropdown-item btn btn-primary btn-sm"
                                        wire:click="edit({{ $group_invoice->id }})">
                                        <i style="color: #0ba360" class="fa fa-edit"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard/invoices.edit_invoice')}}
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_invoice"
                                        wire:click="delete({{ $group_invoice->id }})">
                                        <i style="color: #a30b0b" class="fa fa-trash"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard/invoices.delete_invoice')}}
                                    </a>
                                    <a class="dropdown-item" href="#" wire:click="print({{ $group_invoice->id }})"
                                        class="btn btn-primary btn-sm" target="_blank">
                                        <i style="color: #690ba3" class="fas fa-print"></i>&nbsp;&nbsp;
                                        {{trans('Dashboard/invoices.print_invoice')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @include('livewire.group_invoices.delete')
                    @endforeach
            </table>
        </div>
    </div>
</div>