<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/echo.js'])
    {{-- @livewireStyles --}}
    <style>
       .swal2-toast {
            background-color: #333;
            color: rgb(15, 81, 225);
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 200px;
            height: 30px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-base-200/50 dark:bg-base-200" style="min-height: 100vh">
    {{-- The navbar with `sticky` and `full-width` --}}
    @livewire('nav-bar')
    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        @livewire('side-bar')


        {{-- The `$slot` goes here --}}
        <x-slot:content class="relative px-4 pb-8">
        {{-- <div class="overflow-y-auto"> --}}
            {{ $slot }}
        {{-- </div> --}}
        </x-slot:content>

    </x-mary-main>

    {{--  TOAST area --}}
    <x-mary-toast />

    {{-- <x-mary-toast/> --}}

    <x-mary-spotlight/>

    <x-support-bubble />

    @livewire('wire-elements-modal')
    @livewire('livewire-ui-spotlight')

    {{-- @livewireScripts --}}
    @livewireChartsScripts
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
