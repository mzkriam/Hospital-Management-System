<div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($AppointmentSaved)
    <div class="alert alert-info">{{trans('Dashboard/invoices.saved')}}</div>
    @endif
    @if ($AppointmentUpdated)
    <div class="alert alert-info">{{trans('Dashboard/invoices.updated')}}</div>
    @endif
    @if($show_table)
    @include('livewire.appointments.internal.Table')
    @elseif($show_add)
    @include('livewire.appointments.internal.add')
    @elseif($show_edit)
    @include('livewire.appointments.internal.edit')
    @endif
</div>