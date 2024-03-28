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
    @if ($ServiceSaved)
    <div class="alert alert-info">{{trans("Dashboard\groupServices.saved")}}</div>
    @elseif ($ServiceUpdated)
    <div class="alert alert-info">{{trans("Dashboard\groupServices.edited")}}</div>
    @endif
    @if($show_table)
    @include("livewire.GroupServices.index")
    @else
    @include("livewire.GroupServices.add")
    @endif
</div>