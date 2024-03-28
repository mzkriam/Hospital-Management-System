<!-- Modal -->
<div class="modal fade" id="delete{{ $ray_service->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/ray_service.delete_service')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_service.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $ray_service->id }}">
                    <h5>
                        {{trans('Dashboard/sections_trans.Warning')}}
                    </h5>
                    <h4>
                        {{$ray_service->name }}
                    </h4>
                    <h5>
                        {{$ray_service->description }}
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{trans('Dashboard/sections_trans.Close')}}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{trans('Dashboard/sections_trans.delete')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>