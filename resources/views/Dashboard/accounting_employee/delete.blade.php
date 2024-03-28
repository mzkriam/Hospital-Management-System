<div class="modal fade" id="delete{{ $accounting_employee->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard\doctors_trans.delete_doctor') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('accounting_employee.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{ trans('Dashboard\doctors_trans.Warning') }}</h5>
                    <h4>{{$accounting_employee->name}}</h4>
                    <input type="hidden" value="1" name="page_id">
                    @if($accounting_employee->image)
                    <input type="hidden" name="filename" value="{{$accounting_employee->image->filename}}">
                    @endif
                    <input type="hidden" name="id" value="{{ $accounting_employee->id }}">
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