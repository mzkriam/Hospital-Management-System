<div class="modal fade" id="update_status{{ $medicine->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard\doctors_trans.Status_change') }} {{$medicine->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('admin_medicine.update_status') }}" method="post" autocomplete="off">
                @else
                <form action="{{ route('medicine.update_status') }}" method="post" autocomplete="off">
                    @endif
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">{{trans('Dashboard\doctors_trans.Status')}}</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" selected disabled>--{{trans('Dashboard\doctors_trans.Choose')}}--
                                </option>
                                <option value="0">{{trans('Dashboard\doctors_trans.Enabled')}}</option>
                                <option value="1">{{trans('Dashboard\doctors_trans.Not_enabled')}}</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $medicine->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                        <button type="submit"
                            class="btn btn-primary">{{trans('Dashboard/sections_trans.edit')}}</button>
                    </div>
                </form>
        </div>
    </div>
</div>