<div>
    <div>
        <div class="main-chat-list" id="ChatList">
            <div id="plist" class="people-list">
                <ul class="list-unstyled chat-list mt-2 mb-0">
                    @foreach($conversations as $conversation)
                    <li class="clearfix"
                        wire:click="chatUserSelected({{$conversation}},{{ $this->getUsers($conversation,$name='id')}})">
                        <div class="about"
                            wire:click="chatUserSelected({{$conversation}},{{ $this->getUsers($conversation,$name='id')}})">
                            <div class="name"
                                wire:click="chatUserSelected({{$conversation}},{{ $this->getUsers($conversation,$name='id')}})">
                                {{$this->getUsers($conversation,$name='name')}}</div>
                            <div class="status"
                                wire:click="chatUserSelected({{$conversation}},{{ $this->getUsers($conversation,$name='id')}})">
                                <i class="fa fa-circle offline"></i>
                                left {{$conversation->Messages->last()->created_at->shortAbsoluteDiffForHumans()}}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>