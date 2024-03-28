@extends('Dashboard.layouts.master')


@section('title')
{{trans('Dashboard/invoices.single_service_invoices')}}
@endsection
@section('content')
<div class="container-fluid">
    <livewire:single-invoices />
</div>
</div>

@endsection
</body>


</html>