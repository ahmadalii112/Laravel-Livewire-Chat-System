<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class ChatList extends Component
{
    public $authId, $conversations, $receiverInstance, $selectedConversation;
    protected $listeners = ['chatUserSelected', 'refresh' => '$refresh'];

    public function mount()
    {
        $this->authId = auth()->id();
        $this->conversations = Conversation::where('sender_id', $this->authId)
            ->orWhere('receiver_id', $this->authId)
            ->latest('last_time_message')->get();
    }

    public function render()
    {
        return view('livewire.chat.chat-list');
    }

    public function getChatUserInstance(Conversation $conversation, $request)
    {
        $this->authId = auth()->id();
        # get selected conversation
        $this->receiverInstance = ($conversation->sender_id == $this->authId)
            ? User::firstWhere('id', $conversation->receiver_id)
            : User::firstWhere('id', $conversation->sender_id);
        if (isset($request)) {
            return $this->receiverInstance->$request;
        }
    }

    public function chatUserSelected(Conversation $conversation, $receiverId)
    {
        $this->selectedConversation = $conversation;
        $receiverInstance = User::find($receiverId);
        $this->emitTo('chat.chatbox', 'loadConversation', $this->selectedConversation, $receiverInstance);
        $this->emitTo('chat.send-message', 'updateSendMessage', $this->selectedConversation, $receiverInstance);
    }
}
