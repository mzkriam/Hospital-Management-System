@extends('Dashboard.layouts.master')


@section('title')
{{trans("Dashboard\groupServices.group_services")}}
@endsection
@section('content')
<div class="container-fluid">
    <livewire:create-group-services />
</div>
</div>

@endsection
</body>


</html>