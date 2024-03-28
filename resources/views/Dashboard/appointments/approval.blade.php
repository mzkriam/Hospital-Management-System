<div class="modal fade" id="add_appointment{{ $appointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/appointments.accepted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(auth('admin')->check())
                <form action="{{ route('admin_appointments.appointment') }}" method="post">
                    @else
                    <form action="{{ route('appointments.appointment') }}" method="post">
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $appointment->id }}">
                        <!--div-->
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">
                                        {{trans('Dashboard/appointments.name')}} :
                                    </label>
                                </div>
                                <div class="col-8">
                                    <label class="form-label">
                                        {{$appointment->name}}
                                    </label>
                                </div>
                            </div>
                            <div class="my-2"></div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="appointment" class="form-label">
                                        {{trans('Dashboard/appointments.appointment')}} :
                                    </label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" type="datetime-local" id="appointment"
                                        name="appointment" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{trans('Dashboard/sections_trans.Close')}}
                            </button>
                            <button class="btn btn-success">
                                {{trans('Dashboard/sections_trans.save')}}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>