<!-- Modal -->
<div wire:ignore.self class="modal fade" id="delete_invoice" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/invoices.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{trans('Dashboard/invoices.deleting')}}
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