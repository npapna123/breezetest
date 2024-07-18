<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto">
        <div class="columns-3">
            <p>Well, let me tell you something, ...</p>
            <p class="break-inside-avoid-column">Sure, go ahead, laugh...</p>
            <p>Maybe we can live without...</p>
            <p>Look. If you think this is...</p>
            <p>Look. If you think this is...</p>
        </div>

        <div>
            <div>
                <span class="box-decoration-slice bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-2">Hello<br />World</span>
            </div>
            <div>
                <span class="box-decoration-clone bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-2">Hello<br />World</span>
            </div>
        </div>

        <div>
            <div class="box-border h-32 w-32 p-4 border-4">
               test
            </div>
        </div>

        <div class="flex">
            <div class="flex-1">01</div>
            <div class="contents">
                <div class="flex-1">02</div>
                <div class="flex-1">03</div>
            </div>
            <div class="flex-1">04</div>
        </div>

        <div>
            <span class="inline-grid grid-cols-3 gap-4">
              <span class="bg-slate-800 w-11 h-11">01</span>
              <span class="bg-slate-800 w-11 h-11">02</span>
              <span class="bg-slate-800 w-11 h-11">03</span>
              <span class="bg-slate-800 w-11 h-11">04</span>
              <span class="bg-slate-800 w-11 h-11">05</span>
              <span class="bg-slate-800 w-11 h-11">06</span>
            </span>
            <span class="inline-grid grid-cols-3 gap-4">
              <span class="bg-slate-800 w-11 h-11">01</span>
              <span class="bg-slate-800 w-11 h-11">02</span>
              <span class="bg-slate-800 w-11 h-11">03</span>
              <span class="bg-slate-800 w-11 h-11">04</span>
              <span class="bg-slate-800 w-11 h-11">05</span>
              <span class="bg-slate-800 w-11 h-11">06</span>
            </span>
        </div>


        <div class="grid md:grid-cols-2">
            <div class="border-2">01</div>
            <div class="border-2">03</div>
        </div>


    </div>
</body>
</html>
