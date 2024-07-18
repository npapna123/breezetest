<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;

class ChatComponent extends Component
{

    public $message;
    public $convo = [];

    protected $listeners = ['echo:our-channel,MessageEvent' => 'listenForMessage'];

    public function submitMessage()
    {
        MessageEvent::dispatch(auth()->id(), $this->message);
        $this->reset('message');
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount()
    {
        $messages = Message::with('user')->get();
        foreach ($messages as $message) {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message,
                'id' => $message->user->id
            ];
        }
    }

    #[On('echo:our-channel,MessageEvent')]
    public function listenForMessage($data)
    {
        $this->convo[] = [
            'username' => $data['username'],
            'message' => $data['message'],
            'id' => $data['id']
        ];
    }
}
