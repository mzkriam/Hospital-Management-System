@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard/main-sidebar_trans.internal_appointments')}}
@endsection
@section('content')
<div class="container-fluid">
    <livewire:appointments.internal.appointment-internal />
</div>
</div>

@endsection
</body>


</html>