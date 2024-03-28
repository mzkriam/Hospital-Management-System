<div class="modal fade" id="deleted_laboratorie{{$patient_Laboratorie->id}}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/invoices.delete_invoice')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Laboratories.destroy', $patient_Laboratorie->id) }}" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <p class="h5">{{trans('Dashboard/invoices.deleting')}} </p>
                            <p>{{trans('Dashboard/invoices.required')}} : {{ $patient_Laboratorie->description }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{trans('Dashboard/insurance.close')}}
                        </button>
                        <button class="btn btn-danger"
                            type="submit">{{trans('Dashboard/doctors_trans.delete')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>