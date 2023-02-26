<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{
    public Conversation $selectedConversation;
    public User $receiverInstance;
    public $body;
    protected $listeners = ["updateSendMessage"];

    public function updateSendMessage(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function sendMessage()
    {
        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);
        $this->selectedConversation->last_time_message = now();
        $this->selectedConversation->save();
        $this->emitTo("chat.chatbox","pushMessage", $createdMessage->id);
        # refresh conversation list
        $this->emitTo("chat.chat-list", "refresh");
        $this->reset('body');
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
