<div>
    @if($selectedConversation)
    <div class="chat">
        <div class="chat-header clearfix">
            <div class="row">
                <div class="col-lg-6">
                    <div class="chat-about">
                        <h6 class="m-b-0">{{$receiveUser['name']}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-history">
            <ul class="m-b-0">
                @foreach($messages as $message)
                <li class="clearfix">
                    <div
                        class="message {{$auth_email == $message->sender_email ?'my-message':'other-message float-right'}}">
                        {{$message->body}}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
</div>