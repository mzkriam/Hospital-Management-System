<div wire:ignore.self class="modal fade" id="delete_service" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard\Services.delete_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>{{trans('Dashboard/invoices.deleting')}}</h5>
                @if($service_selected)
                <h6 class="text-muted">{{$service_selected->name}}</h6>
                <h6 class="text-muted">{{$service_selected->section->name}}</h6>
                <h6 class="text-muted">{{$service_selected->doctor->name}}</h6>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                <button type="button" wire:click.prevent="destroy()"
                    class="btn btn-danger">{{trans('Dashboard/sections_trans.delete')}}</button>
            </div>
        </div>
    </div>
</div>