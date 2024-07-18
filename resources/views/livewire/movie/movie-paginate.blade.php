<?php
use App\Models\Movie;

use function Livewire\Volt\on;
use function Livewire\Volt\state;
use function Livewire\Volt\computed;
use function Livewire\Volt\{rules};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;


state(['search', 'nameMovie', 'movieId', 'linkMovie']);


rules(['nameMovie' => 'required', 'linkMovie' => 'required']);

$movies = computed(function () {
    return Movie::where('name', 'like', '%'.$this->search.'%')->paginate(5);
});

on(['movie-created']);

$delete = function ($id) {

    try {
        $movie = Movie::findOrFail($id); // Use findOrFail to handle non-existing movies
        $this->authorize('delete', $movie);
        $movie->delete();

        session()->flash('message', 'Movie deleted successfully.');
    } catch (AuthorizationException $e) {
        session()->flash('error', 'You are not authorized to delete this movie.');
    } catch (\Exception $e) {
        session()->flash('error', 'An error occurred while trying to delete the movie.');
    }
};

$update = function ($id) {
    $this->validate();
    $movie = Movie::findOrFail($id);
    $movie->update([
        'name' => $this->nameMovie,
        'link' => $this->linkMovie
    ]);
    $this->dispatch('close-modal', action : 'update-movie');
};

?>

<div>
    @if(session('error'))
        <div class="alert alert-success" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" wire:model.live="search" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Movie Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Links
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($this->movies as $movie)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="{{ $movie->id }}">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $movie->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $movie->link }}
                    </td>

                    <td class="px-6 py-4">
                        <x-danger-button wire:click="delete({{ $movie->id }})">Delete</x-danger-button>

                    <x-secondary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', {
                            action:'update-movie',
                            id: {{ $movie->id }},
                            movieName:'{{ $movie->name }}',
                            movieLink: '{{ $movie->link }}',
                            })">
                        {{ __('Edit') }}</x-secondary-button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-10">
        {{ $this->movies->links() }}
    </div>

        <!-- Modal -->
        <div x-data="" @open-modal.window="handleOpenModal($event)" >
            <x-modal name="update-movie" maxWidth="sm" x-show="showModal" :show="false" x-transition x-on:click.away="showModal = false; resetValidationErrors();" focusable>
                <div x-ref="modal">
                    <form wire:submit.prevent="updateMovie" class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Update Movie') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Movie information.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="nameMovie" value="{{ __('Movie Name') }}" class="sr-only" />
                            <x-text-input
                                wire:model="nameMovie"
                                type="text"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Movie Name') }}"
                            />
                            <x-input-error :messages="$errors->get('nameMovie')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="linkMovie" value="{{ __('Movie Link') }}" class="sr-only" />
                            <x-text-input
                                wire:model="linkMovie"
                                type="text"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Movie Link') }}"
                            />
                            <x-input-error :messages="$errors->get('linkMovie')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-secondary-button class="ms-3" wire:click="update({{ $movieId }})">
                                {{ __('Update Movie') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </x-modal>
        </div>


</div>

<script>
    function handleOpenModal(event) {
        const { action, id, movieName, movieLink } = event.detail;

        if(action === 'update-movie') {
            @this.set('movieId', id);
            @this.set('nameMovie', movieName);
            @this.set('linkMovie', movieLink);
        }
    }

    function resetValidationErrors() {
        alert(22);
        @this.resetErrorBag();
    }
</script>


