<div wire:ignore.self class="modal fade" id="update_status" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard\doctors_trans.Status_change') }}
                    @if($appointment)
                    {{$appointment->name}}
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="new_status">{{trans('Dashboard\doctors_trans.Status')}}</label>
                    <select wire:model='new_status' class="form-control" id="new_status" name="new_status" required>
                        <option value="" selected disabled>{{trans('Dashboard\doctors_trans.Choose')}}</option>
                        <option value="uncertain">{{trans('Dashboard\appointments.uncertain')}}</option>
                        <option value="certain">{{trans('Dashboard\appointments.certain')}}</option>
                        <option value="canceled">{{trans('Dashboard\appointments.canceled')}}</option>
                    </select>
                </div>
                @if($appointment)
                <input type="hidden" name="id" value="{{ $appointment->id }}">
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                <button wire:click.prevent='update_status()' type="submit"
                    class="btn btn-primary">{{trans('Dashboard/sections_trans.edit')}}</button>
            </div>
        </div>
    </div>
</div>