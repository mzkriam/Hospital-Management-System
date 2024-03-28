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
    @if ($catchError)
    <div class="alert alert-danger" id="success-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ $catchError }}
    </div>
    @endif
    @if ($ServiceSaved)
    <div class="alert alert-info">{{trans('Dashboard/invoices.saved')}}</div>
    @endif
    @if ($ServiceUpdated)
    <div class="alert alert-info">{{trans('Dashboard/invoices.updated')}}</div>
    @endif
    @if($show_table)
    @include('livewire.Services.Table')
    @else
    @include('livewire.Services.add')
    @endif
</div>