<div>
    Master

    <div x-data="{
        open: false,
        name: 'Bok',
        search: '',
        posts: [
            { title: 'Title One' },
            { title: 'Title Two' },
            { title: 'Title Three' },
            { title: 'Title Four' }
        ]

    }">
        <button
            x-on:click="open = !open"
            x-bind:class="open ? 'bg-blue-400' : 'bg-slate-800'"
            class="bg-slate-800 text-white px-4 py-2 rounded">Toggle</button>

        <div x-show="open" x-transition x-cloak>
            <p class="bg-gray-200 p-4 my-6 rounded">
                Lorem ipsum.
            </p>
        </div>

        <div class="my-4">
            The value of name is <span class="font-bold" x-text="name"></span>
        </div>

        <div x-effect="console.log(open)">

        </div>

        <div class="mt-4">
            <input
                x-model="search"
                type="text"
                placeholder="Search for something..."
                class="border p-2 w-full mb-2 mt-6" />

            <span class="font-bold">Searching for: </span>
            <span x-text="search"></span>
        </div>

        <div>
            <template x-if="open">
                <div class="bg-gray-50 p-2 mt-8">
                    Template based on a condition
                </div>
            </template>
        </div>

        <div>
            <h3 class="text-2xl mt-6 mb-3 font-bold">This is a posts</h3>
            <template x-for="post in posts">
                <div x-text="post.title"></div>
            </template>

            <button
                @click="posts.push({title: 'new post'})"
                class="bg-blue-800 text-white px-4 py-2 rounded-lg mt-4">Add post</button>
        </div>

        <!-- $refs -->
        <div class="my-6">
            <div x-ref="text">Hello World</div>
                <button
                    @click="$refs.text.remove()"
                    class="bg-black text-white p-2 rounded-lg">Click</button>

        </div>


        <!-- x-html -->
        <div x-data="{ username: '<strong>calebporzio</strong>' }">
            Username: <span x-html="username"></span>
        </div>

        <!-- $el.innerHTML -->
        <div class="mt-4">
            <button @click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>
        </div>
        <!-- init and $watch -->
        <div x-init="$watch('posts', value => console.log(value))"></div>

        <!-- $dispatch -->
        <div @notify="alert('You have been notified!')">
            <button
                @click="$dispatch('notify')"
                class="bg-green-700 text-white p-2 mt-4 rounded-lg">
                Notify
            </button>
        </div>

        <div
            x-data="{ title: 'Hello' }"
            @set-title.window="title = $event.detail"
        >
            <h1 x-text="title"></h1>
        </div>

        <div x-data>
            <button
                class="bg-green-700 text-white p-2 mt-4 rounded-lg"
                @click="$dispatch('set-title', 'Hello World!')">Click me</button>
        </div>

        <!-- $data -->
        <div>
            <button
                @click="getLatestPost($data.posts)"
                class="bg-orange-500 text-white p-2 mt-4 rounded-lg">
                Get latest post
            </button>
        </div>



    </div>

    <footer x-data>
        <p>Copyright &copy; <span x-text="new Date().getFullYear()"></span></p>
    </footer>


    <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        <input datepicker id="default-datepicker" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
    </div>

</div>


<script>
    function getLatestPost(posts) {
        console.log(posts.slice(-1).pop())
    }


</script>
