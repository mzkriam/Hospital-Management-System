<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        {{trans("Dashboard\groupServices.group_services")}}
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            {{trans('Dashboard/main-sidebar_trans.show_all')}}
        </span>
    </h1>
    <button wire:click="show_form_add" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>
        {{trans("Dashboard\groupServices.add_a_group_of_services")}}
    </button>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans("Dashboard\groupServices.group_name")}}</th>
                        <th>{{trans("Dashboard\groupServices.total_with_tax")}}</th>
                        <th>{{trans("Dashboard\groupServices.notes")}}</th>
                        <th>{{trans("Dashboard\groupServices.processes")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                        <td>{{ $group->notes }}</td>
                        <td>
                            <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i
                                    class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteGroup{{ $group->id }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @include('livewire.GroupServices.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>