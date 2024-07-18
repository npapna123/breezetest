<?php

use App\Livewire\Forms\MovieForm;
use function Livewire\Volt\form;

form(MovieForm::class);

$create = function () {
    $this->form->store();
    $this->dispatch('movie-created');
    session('movie-created', 'Successfully save.');
}
?>

<div>
    <form wire:submit="create">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Movie Name')"  />
                <x-text-input wire:model="form.name" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="link" :value="__('Link')"  />
                <x-text-input wire:model="form.link" type="text" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('form.link')" class="mt-2" />
            </div>
            <div>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
    </form>
</div>

