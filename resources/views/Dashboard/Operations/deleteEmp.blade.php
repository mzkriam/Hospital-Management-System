<div class="modal fade" id="deleteOperation{{ $operation->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard\operations.delete_operation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operation.destroy',$operation->id) }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{ trans('Dashboard\doctors_trans.Warning') }}</h5>
                    <h5>{{$operation->name}}</h5>
                    <input type="hidden" name="id" value="{{ $operation->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/sections_trans.delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>