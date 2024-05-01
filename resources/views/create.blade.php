<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Post It</title>
    </head>
    <body >
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <header><p>Header</p>
                </header>
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <form method="POST" action="{{ url('post/save') }} "  enctype="multipart/form-data">
                        @csrf
                        <input name="title" type="text" placeholder="Enter Title"/>
                        <input name="description" type="text" placeholder="Enter Description"/>
                        <input name="content" type="text" placeholder="Enter Content"/>
                        <input name="image" type="file" placeholder="Choose Image"/>
                        <input name="category" type="text" placeholder="Enter Category" />
                        <input type="submit" value="Save"/>
                        </form>
                        </div>
                    </main>
                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <p>Footer</p>
                    </footer>
                </div>
    </body>
</html>
