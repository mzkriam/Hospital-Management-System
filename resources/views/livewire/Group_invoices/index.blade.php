@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/main-sidebar_trans.group_invoices')}}
@endsection
@section('content')
<div class="container-fluid">
    <livewire:group-invoices />
</div>
</div>

@endsection
</body>


</html>