<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateChat extends Component
{
    public $message = "Hello, How are You";

    public function checkConversation($receiverId)
    {
        $checkedConversation = Conversation::query()
            ->where(['receiver_id' => auth()->id(), 'sender_id' => $receiverId])
            ->orWhere(['receiver_id' => $receiverId, 'sender_id' => auth()->id()])
            ->get();
        # if conversation does not exist then create a conversation
        if ($checkedConversation->count() >= 0 ) {
            $conversation = Conversation::updateOrCreate(['receiver_id' => $receiverId, 'sender_id' => auth()->id()],['receiver_id' => $receiverId, 'sender_id' => auth()->id(), 'last_time_message' => now()]);
            # create a message using relationship
            $conversation->messages()->create(['receiver_id' => $receiverId, 'sender_id' => auth()->id(), 'body' => $this->message]);
            dd('saved');
        } else {
            dd("else");
        }
    }

    public function render()
    {
        return view('livewire.chat.create-chat', [
            'users' => User::all()->except(Auth::id())
        ]);
    }
}
