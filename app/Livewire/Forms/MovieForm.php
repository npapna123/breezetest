<?php

namespace App\Livewire\Forms;

use App\Notifications\Newslack;
use Illuminate\Support\Facades\Notification;
use App\Models\Movie;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MovieForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string')]
    public string $link = '';

    public function store()
    {
       $this->validate();
        Movie::create([
            'name' => $this->name,
            'link' => $this->link,
            'user_id' => auth()->id()
        ]);

       // Notification::route('slack', config('notification.slack_backend'))->notify(new Newslack($this->name));
        $this->reset();
    }


}
