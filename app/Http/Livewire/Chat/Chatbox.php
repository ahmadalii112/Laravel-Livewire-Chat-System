<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{
    protected $listeners = ['loadConversation', 'pushMessage', 'loadMore'];
    public $selectedConversation, $receiverInstance;
    public $messageCount, $messages;
    public $height;
    public $paginate = 10;

    public function loadConversation(Conversation $conversation, User $receiver)
    {
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
        $this->messageCount = Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messageCount - $this->paginate)
            ->take($this->paginate)->get();
        $this->dispatchBrowserEvent('chatSelected');
    }

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    public function loadMore()
    {
        $this->paginate += 10;
        $this->messageCount = Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
            ->skip($this->messageCount - $this->paginate)
            ->take($this->paginate)->get();
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
