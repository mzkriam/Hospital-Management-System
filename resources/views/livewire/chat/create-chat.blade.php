<div wire:ignore>
    @section('title')
    {{trans('Dashboard/main-sidebar_trans.accounting_employee')}}
    @endsection
    @section('page-header')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{trans('Dashboard/main-sidebar_trans.accounting_employee')}}
                <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">
                    / {{trans('Dashboard/main-sidebar_trans.show_all')}}
                </span>
            </h1>
        </div>
        @endsection
        @section('content')
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><input class="text-center border-0" wire:model="receive"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <button class="w-100 border-0 bg-transparent"
                                        wire:click="createConversation('{{$user->email}}')">
                                        {{$user->name}}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>