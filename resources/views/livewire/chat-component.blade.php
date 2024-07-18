<div>

    <div class="container w-[40%] m-auto">
        <h1 class="font-bold text-white text-3xl">Anime Feed</h1>
        <div class="border-2 p-4 h-[20rem]">
            @foreach($convo as $item)
                <div class="flex align-middle items-center">
                    <div class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 fill-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <div>
                        @if ($item['id'] == 1)
                            <p class="text-white text-sm"><b><span class="text-green-500">{{ $item['username'] }}</span> <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Admin</span> :</b>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $item['message'] }}</span>
                            </p>
                        @else
                            <p class="text-white text-sm"><b>{{ $item['username'] }} :</b> <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $item['message'] }}</span> </p>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5">
            <form wire:submit="submitMessage">
                <div class="relative">
                    <x-text-input wire:model="message" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-white dark:focus:border-white" />
                    <x-primary-button type="submit" class="text-white absolute end-2.5 bottom-2.5">Send</x-primary-button>
                </div>
            </form>
        </div>
    </div>

</div>

