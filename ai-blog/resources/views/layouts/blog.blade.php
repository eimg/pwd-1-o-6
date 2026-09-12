<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Ink & Signal' }} · {{ config('app.name', 'Ink & Signal') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <script>
        (() => {
            const savedTheme = localStorage.getItem('ink-signal-theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.documentElement.dataset.theme = savedTheme || systemTheme;
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-shell" x-data="theme" x-init="init()">
    <header class="site-header">
        <div class="container nav-wrap">
            <a href="{{ route('posts.index') }}" class="brand"><span class="brand-mark">i</span><span>ink & signal</span></a>
            <nav class="main-nav" aria-label="Main navigation">
                <a href="{{ route('posts.index') }}">Stories</a>
                @auth
                    <a href="{{ route('posts.create') }}">Write</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-form">@csrf<button type="submit">Log out</button></form>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}" class="nav-cta">Join the journal</a>
                @endauth
                <button type="button" class="theme-toggle" x-on:click="toggle()" x-bind:aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'" x-bind:aria-pressed="dark" title="Toggle color theme"><span class="theme-icon" x-text="dark ? '☼' : '☾'"></span><span x-text="dark ? 'Light' : 'Dark'"></span></button>
            </nav>
        </div>
    </header>

    @if (session('success'))
        <div class="container"><div class="flash flash-success">{{ session('success') }}</div></div>
    @endif

    <main>@yield('content')</main>

    <footer class="site-footer"><div class="container footer-wrap"><span>ink & signal</span><span>A small journal for useful ideas.</span></div></footer>
</body>
</html>
