@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.sections')}}
@endsection


@section('page-header')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{trans('Dashboard/main-sidebar_trans.sections')}}
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                {{trans('Dashboard/main-sidebar_trans.show_all')}}
            </span>
        </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @endsection
    @section('content')
    @include('Dashboard.messages_alert')





</div>
</div>

@endsection
</body>

</html>