<div class="modal fade" id="edit_xray_conversion{{$patient_ray->id}}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{trans("Dashboard/invoices.transfer_to_laboratory")}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('rays.update',$patient_ray->id)}}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">
                                    {{trans('Dashboard/invoices.required')}}
                                </label>
                                <textarea rows="5" id="description" name="description" class="form-control"
                                    required>{{ $patient_ray->description}}</textarea>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{trans('Dashboard/sections_trans.Close')}}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{trans('Dashboard/sections_trans.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>