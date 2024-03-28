<div>
    @if($selectedConversation)

    <form wire:submit.prevent='sendMessage'>
        <div class="chat-message clearfix">
            <div class="input-group mb-0">
                <div class="input-group-prepend">
                    <button type="submit" class="input-group-text"><i class="fa fa-send"></i></button>
                </div>
                <input wire:model='body' type="text" class="form-control" placeholder="Enter text here...">
            </div>
        </div>
    </form>
    @endif
</div>