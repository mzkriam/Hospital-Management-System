<div class="modal fade" id="delete{{ $medicine->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/medicine.delete_medicine')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('admin_medicine.destroy', 'test') }}" method="post">
                @else
                <form action="{{ route('medicine.destroy', 'test') }}" method="post">
                    @endif
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $medicine->id }}">
                        <h5>
                            {{trans('Dashboard/sections_trans.Warning')}}
                        </h5>
                        <h4>
                            {{$medicine->name }}
                        </h4>
                        <h5>
                            {{$medicine->description }}
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