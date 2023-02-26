<div>
    <div class="chatlist_header">
        <div class="title">
            Chat
        </div>
        <div class="img_container">
            <img src="https://picsum.photos/id/237/200/300" alt="">
        </div>
    </div>

    <div class="chatlist_body">
        @forelse($conversations as $conversation)
            <div class="chatlist_item">
                <div class="chatlist_img_container">
                    <img src="https://picsum.photos/id/{{ $this->getChatUserInstance($conversation, 'id') }}/200/300" alt="">
                </div>
                <div class="chatlist_info">

                    <div class="top_row">
                        <div class="list_username">{{$this->getChatUserInstance($conversation, 'name')}}</div>
                        <span class="date">{{ $conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans() }}</span>
                    </div>

                    <div class="bottom_row">
                        <div class="message_body text-truncate">
                            {{ $conversation->messages->last()->body }}
                        </div>
                        <div class="unread_count">
                            56
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3> No Conversation Found</h3>

        @endforelse
    </div>
</div>
