<!-- Modal -->
<div class="modal fade" id="edit{{ $laboratory_service->id }}" ttabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/ray_service.edit_service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratory_service.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <input type="hidden" name="id" value="{{ $laboratory_service->id }}">
                                <label for="name" class="form-label">
                                    {{trans('Dashboard/ray_service.name')}}
                                </label>
                                <input id="name" type="text" name="name" value="{{ $laboratory_service->name }}"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="laboratory_employ_id" class="form-label">
                                    {{trans('Dashboard/ray_service.ray_employ_id')}}
                                </label>
                                <select id="laboratory_employ_id" type="text" name="laboratory_employ_id"
                                    class="form-control">
                                    <option disabled>{{trans('Dashboard/invoices.choose_from_the_list')}}</option>
                                    @foreach($laboratory_employees as $laboratory_employee)
                                    <option value="{{$laboratory_employee->id}}" {{$laboratory_employee->
                                        laboratory_employ_id
                                        ==
                                        'laboratory_employ_id' ? 'selected' : ""}}>{{$laboratory_employee->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="price" class="form-label">
                                    {{trans('Dashboard/ray_service.price')}}
                                </label>
                                <input id="price" type="number" min="0" step="0.01" name="price"
                                    value="{{ $laboratory_service->price }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="code" class="form-label">
                                    {{trans('Dashboard/ray_service.code')}}
                                </label>
                                <input id="code" type="text" name="code" value="{{ $laboratory_service->code }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea rows="5" id="description" name="description" class="form-control"
                                    required>{{ $laboratory_service->description }}</textarea>
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