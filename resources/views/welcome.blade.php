<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <flux:main>
        <flux:heading size="xl">Welcome to {{ config('app.name', 'Laravel') }}</flux:heading>
        <flux:subheading>Welcome to your new Laravel app with Livewire and Flux!</flux:subheading>
        <flux:spacer />
        <flux:button href="/login" variant="primary">Login</flux:button>
        <flux:button href="/register" variant="outline">Register</flux:button>
    </flux:main>
</body>
</html>
