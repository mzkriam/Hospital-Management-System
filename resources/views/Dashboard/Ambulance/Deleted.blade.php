<div class="modal fade" id="Deleted{{$ambulance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/ambulances.delete_car')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('Ambulance.destroy','test')}}" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$ambulance->id}}">
                    <div class="row">
                        <div class="col">
                            <h5>{{ trans('Dashboard\doctors_trans.Warning') }}</h5>
                            <h6>{{$ambulance->car_number}}</h6>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('Dashboard/insurance.close')}}
                        </button>
                        <button class="btn btn-danger" type="submit">{{trans('Dashboard/doctors_trans.delete')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>