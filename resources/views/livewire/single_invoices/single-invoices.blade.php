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
    @if ($InvoiceSaved)
    <div class="alert alert-info">{{trans('Dashboard/invoices.saved')}}</div>
    @endif
    @if ($InvoiceUpdated)
    <div class="alert alert-info">{{trans('Dashboard/invoices.updated')}}</div>
    @endif
    @if($show_table)
    @include('livewire.single_invoices.Table')
    @else
    @include('livewire.single_invoices.add')
    @endif
</div>