@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.sections')}}
@endsection
@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.sections')}}
            <span class="h5 text-muted mt-1 tx-13 mr-2 mb-0">/
                {{trans('Dashboard/main-sidebar_trans.show_all')}}
            </span>
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addSection ">
            <i class=" fas fa-download fa-sm text-white-50"></i>
            {{trans('Dashboard/sections_trans.add_sections')}}
        </a>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th>{{trans('Dashboard/sections_trans.name_sections')}}</th>
                            <th>{{trans('Dashboard/sections_trans.head_of_department')}}</th>
                            <th>{{trans('Dashboard/sections_trans.location')}}</th>
                            <th>{{trans('Dashboard/sections_trans.contact_number')}}</th>
                            <th>{{trans('Dashboard/sections_trans.description')}}</th>
                            <th>{{trans('Dashboard/sections_trans.created_at')}}</th>
                            <th>{{trans('Dashboard/sections_trans.Processes')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>#</td>
                            <th>{{trans('Dashboard/sections_trans.name_sections')}}</th>
                            <th>{{trans('Dashboard/sections_trans.head_of_department')}}</th>
                            <th>{{trans('Dashboard/sections_trans.location')}}</th>
                            <th>{{trans('Dashboard/sections_trans.contact_number')}}</th>
                            <th>{{trans('Dashboard/sections_trans.description')}}</th>
                            <th>{{trans('Dashboard/sections_trans.created_at')}}</th>
                            <th>{{trans('Dashboard/sections_trans.Processes')}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <a class="text-decoration-none" href="{{route('Sections.show',$section->id)}}">
                                    {{$section->name}}
                                </a>
                            </td>
                            <td>{{$section->head_of_department}}</td>
                            <td>{{$section->location}}</td>
                            <td>{{$section->contact_number}}</td>
                            <td>{{\Str::limit($section->description, 50)}}</td>
                            <td>{{$section->created_at->diffForHumans()}}</td>
                            <td><a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                    data-toggle="modal" href="#edit{{$section->id}}">
                                    <span class="fas fa-user"></span>
                                </a>
                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-toggle="modal" href="#delete{{$section->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @include('Dashboard.Sections.edit')
                        @include('Dashboard.Sections.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('Dashboard.Sections.add')
</div>
</div>

<!-- Modal -->

@endsection
</body>

</html>