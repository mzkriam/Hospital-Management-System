<!-- Modal -->
<div class="modal fade" id="edit{{ $section->id }}" ttabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/sections_trans.edit_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Sections.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name_section" class="form-label">
                                    {{trans('Dashboard/sections_trans.name_sections')}}
                                </label>
                                <input type="hidden" name="id" value="{{ $section->id }}">
                                <input id="name_section" type="text" name="name" value="{{ $section->name }}"
                                    class="form-control" required>
                                <div class="valid-feedback">
                                    {{ trans('validation.good')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{ trans('validation.required_filed')}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="head_of_department" class="form-label">
                                    {{trans('Dashboard/sections_trans.head_of_department')}}
                                </label>
                                <select id="head_of_department" type="text" name="head_of_department"
                                    class="form-control">
                                    <option disabled>{{trans('Dashboard/invoices.choose_from_the_list')}}</option>
                                    <option value="{{ $section->head_of_department }}" selected>
                                        {{$section->head_of_department }}
                                    </option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor->name}}">{{$doctor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="location" class="form-label">
                                    {{trans('Dashboard/sections_trans.location')}}
                                </label>
                                <input id="location" type="text" name="location" value="{{ $section->location }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="contact_number" class="form-label">
                                    {{trans('Dashboard/sections_trans.contact_number')}}
                                </label>
                                <input id="contact_number" type="number" name="contact_number"
                                    value="{{ $section->contact_number }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="description_section" class="form-label">
                                    {{trans('Dashboard/sections_trans.description')}}
                                </label>
                                <textarea rows="5" id="description_section" name="description" class="form-control"
                                    required>{{ $section->description }}</textarea>
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