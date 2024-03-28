<div class="modal fade" id="edit{{ $medicine->id }}" ttabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/medicine.edit_medicine')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth('admin')->check())
            <form action="{{ route('admin_medicine.update', 'test') }}" method="post">
                @else
                <form action="{{ route('medicine.update', 'test') }}" method="post">
                    @endif
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="hidden" name="id" value="{{ $medicine->id }}">
                                    <label for="name" class="form-label">
                                        {{trans('Dashboard/ray_service.name')}}
                                    </label>
                                    <input id="name" type="text" name="name" value="{{ $medicine->name }}"
                                        class="form-control" required>
                                    <div class="valid-feedback">
                                        {{ trans('validation.good')}}
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ trans('validation.required_filed')}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="pha_employee_id" class="form-label">
                                        {{trans('Dashboard/medicine.pha_employee_id')}}
                                    </label>
                                    <input type="text" class="form-control" name="pha_employee_id" id="pha_employee_id"
                                        value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="price" class="form-label">
                                        {{trans('Dashboard/ray_service.price')}}
                                    </label>
                                    <input id="price" type="number" min="0" step="0.01" name="price"
                                        value="{{ $medicine->price }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="code" class="form-label">
                                        {{trans('Dashboard/ray_service.code')}}
                                    </label>
                                    <input id="code" type="text" name="code" value="{{ $medicine->code }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="description" class="form-label">
                                        {{trans('Dashboard/sections_trans.description')}}
                                    </label>
                                    <textarea rows="5" id="description" name="description" class="form-control"
                                        required>{{ $medicine->description }}</textarea>
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
                            {{trans('Dashboard/sections_trans.edit')}}
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>