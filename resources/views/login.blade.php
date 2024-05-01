<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Post It</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div>
            <h3>Login</h3>
            <div>
            <form method="POST" action="{{ url('login/submit') }} ">
            @csrf
            <input name="email" type="email" placeholder="Enter Email"/>
            <input name="password" type="password" placeholder="Enter Password"/>
            <input type="submit" value="Login"/>
            </form>
            <a href="{{ url('register') }}">Register</a>
            </div>
        </div>
    </body>
</html>
