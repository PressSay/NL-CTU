@props([
'forum',
'threadComments',
'threadPost',
'categoryPost',
'title',
'profile',
'noFooter',
'categories',
'threads',
'threadUser',
'shop',
'shopUpload',])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="garden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width">
    @if (isset($title))
    <title>{{ $title }}</title>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <!-- Scripts -->

    @vite(['resources/js/notification.js'])


    @if (isset($threadComments))
    @vite(['resources/js/threadComment.js'])

    @elseif (isset($categories))
    @vite(['resources/js/categories.js'])

    @elseif (isset($threads))
    @vite(['resources/js/threads.js'])

    @elseif (isset($threadUser))
    @vite(['resources/js/threadUser.js'])

    @elseif (isset($shop))
    @vite(['resources/js/shop.js'])
    @endif

    @if (isset($forum) or isset($threadPost) or isset($categoryPost) or isset($threadComments) or isset($shopUpload))
    @auth
    <script src="{{ asset('minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('minified/plugins/dragdrop.js') }}"></script>
    <script src="{{ asset('minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('minified/icons/monocons.js') }}"></script>
    <!-- <link rel="stylesheet" href="{{ asset('minified/themes/modern.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('minified/themes/defaultdark.min.css') }}">
    @endauth

    @if (isset($forum))
    @vite(['resources/js/forum.js'])

    @elseif (isset($threadPost))
    @vite(['resources/js/threadPost.js'])

    @elseif (isset($categoryPost))
    @vite(['resources/js/categoryPost.js'])

    @endif

    @endif

    @if (isset($profile))
    @vite(['resources/js/app.js'])
    {{-- @vite(['resources/css/app.css']) --}}
    @endif

</head>

<body>

    <div class="container mx-auto flex flex-col justify-between h-screen relative" id="app">
        <div class="alert alert-success shadow-lg  z-50 hidden fixed container">
            <div class="flex justify-between w-full">
                <div id="icon-alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span id="message-alert">Your purchase has been confirmed!</span>
                <button id="close-alert" class="btn btn-xs">X</button>
            </div>
        </div>

        {{-- <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
    </div>
    </header>
    @endif --}}

    @include('layouts.navigation')

    <!-- Page Content -->
    {{ $slot }}


    @unless (isset($noFooter))
    @include('layouts.footer')
    @endunless
    </div>
</body>

</html>