<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Logger') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath d='M17 2H7C5.9 2 5 2.9 5 4V20C5 21.1 5.9 22 7 22H17C18.1 22 19 21.1 19 20V6L14 2H7C6.45 2 6 2.45 6 3V21C6 21.55 6.45 22 7 22H17C17.55 22 18 21.55 18 21V6.5L14.5 3.5C14.2 3.2 13.8 3.2 13.5 3.5L10 7.5V6C10 5.45 9.55 5 9 5H7C6.45 5 6 5.45 6 6V18C6 18.55 6.45 19 7 19H17C17.55 19 18 18.55 18 18V6.5C18 6.2 17.8 6 17.5 6H17V2Z' fill='%green'/%3E%3Cpath d='M7 19C7 19.55 7.45 20 8 20H16C16.55 20 17 19.55 17 19C17 18.45 16.55 18 16 18H8C7.45 18 7 18.45 7 19Z' fill='%23FFC107'/%3E%3C/svg%3E" type="image/svg+xml">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-teal-50 text-teal-800">
        @inertia
    </body>
</html>
