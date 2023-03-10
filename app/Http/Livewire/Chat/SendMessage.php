<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{
    public Conversation $selectedConversation;
    public User $receiverInstance;
    public $body;
    public $createdMessage;
    protected $listeners = ["updateSendMessage", 'dispatchMessage'];

    public function updateSendMessage(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);
        $this->selectedConversation->last_time_message = now();
        $this->selectedConversation->save();
        $this->emitTo("chat.chatbox","pushMessage", $this->createdMessage->id);
        # refresh conversation list
        $this->emitTo("chat.chat-list", "refresh");
        $this->reset('body');
        $this->emitSelf('dispatchMessage');
    }

    public function dispatchMessage()
    {
        broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->selectedConversation, $this->receiverInstance));
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
