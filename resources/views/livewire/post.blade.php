<?php

use App\Models\Blog;

use function Livewire\Volt\{state, usesFileUploads, rules};

usesFileUploads();

state([
    'title' => '',
    'body' => '',
    'image' => null
]);

rules([
    'title' => 'required',
    'body' => 'required',
    'image' => 'image|max:1024',
]);

$addPost = function () {
    $this->validate();
    Blog::create([
        'title' => $this->title,
        'body' => $this->body,
        'image' => $this->image->store('images')
    ]);

    $this->reset();
};

?>

<div>
        <form wire:submit="addPost" enctype="multipart/form-data">
            <div class="my-2">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input wire:model="title" type="text" class="w-full" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="my-2">
                <x-input-label for="body" :value="__('Body')" />
                <x-text-input wire:model="body" type="text" class="w-full" />
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

           <div class="my-2">
                <x-input-label for="image" :value="__('File Upload')" />
                <x-text-input wire:model="image" type="file" class="w-full" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="my-2">
                <x-primary-button>Submit</x-primary-button>
            </div>


        </form>
</div>
