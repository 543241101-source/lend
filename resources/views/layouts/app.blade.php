<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Lab TEFA PPLG</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-8">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-xl font-black tracking-wider text-blue-600">TEFA<span class="text-gray-800">.LAB</span></span>
                        </div>
                        <div class="hidden sm:flex sm:space-x-4">
                            <a href="{{ route('peminjaman.index') }}" class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('peminjaman.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">Peminjaman</a>
                            <a href="{{ route('pengguna.index') }}" class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('pengguna.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">Pengguna</a>
                            <a href="{{ route('peralatan.index') }}" class="px-3 py-2 rounded-md text-sm font-semibold {{ request()->routeIs('peralatan.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">Peralatan</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl text-green-700 flex items-center justify-between shadow-sm animate-fade-in">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
