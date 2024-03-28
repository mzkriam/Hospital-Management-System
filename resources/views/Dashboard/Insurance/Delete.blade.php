<div class="modal fade" id="Deleted{{$insurance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard\insurance.delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('adminInsurance.destroy', 'test') }}" method="post">
                @else
                <form action="{{ route('Insurance.destroy', 'test') }}" method="post">
                    @endif
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <h5>{{ trans('Dashboard\doctors_trans.Warning') }}</h5>
                        <h5>{{$insurance->name}}</h5>
                        <input type="hidden" value="1" name="page_id">
                        <input type="hidden" name="id" value="{{ $insurance->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                        <button type="submit"
                            class="btn btn-danger">{{trans('Dashboard/sections_trans.delete')}}</button>
                    </div>
                </form>
        </div>
    </div>
</div>