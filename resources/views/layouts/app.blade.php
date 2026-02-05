<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200">
    <div class="flex h-screen overflow-hidden">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="justify-between flex p-4 bg-white items-center">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('title', 'Dashboard')
                </h2>
                <div class="text-gray-600">Halo, {{ Auth::user()->nama_lengkap ?? 'Guest' }}</div>
            </header>
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
