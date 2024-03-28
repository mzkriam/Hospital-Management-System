<div class="modal fade" id="update_password{{ $Patient->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard\doctors_trans.update_password') }} / {{$Patient->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('adminPatients.update_password') }}" method="post" autocomplete="off">
                @else
                <form action="{{ route('Patients.update_password') }}" method="post" autocomplete="off">
                    @endif
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="password">{{ trans('Dashboard\doctors_trans.new_password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="password_confirmation">{{
                                        trans('Dashboard\doctors_trans.confirm_password')
                                        }}</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" required>

                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $Patient->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                        <button type="submit"
                            class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                    </div>
                </form>
        </div>
    </div>
</div>