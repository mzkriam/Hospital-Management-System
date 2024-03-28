@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/main-sidebar_trans.Single_service')}}
@endsection
@section('content')
<div class="container-fluid">
    <livewire:services />
</div>
</div>

@endsection
</body>


</html>