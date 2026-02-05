<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-600">
    <div class="items-center justify-center flex h-screen">
        <div class="w-96 h-auto bg-blue-400 rounded-2xl items-center justify-center p-4">
            <h1 class="text-lg text-center mt-2 font-bold">Login</h1>
            @if ( $errors->any() )
            <div>
                <h1>Eror</h1>
                @foreach ( $errors->all() as $error )
                    <p>{{ $error }}</p>
                @endforeach
            </div>

            @endif
            <form action="{{ route('login') }}" method="POST" class="justify-center items-center">
                @csrf
                <div class="w-full flex flex-col items-center">
                    <input type="email" name="email" placeholder="Username" class="w-80 h-8 mt-4 rounded-lg p-2">
                </div>
                <div class="w-full flex flex-col items-center">
                    <input type="password" name="password" placeholder="Password" class="w-80 h-8 mt-4 rounded-lg p-2">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="w-80 h-8 mt-4 rounded-lg bg-gray-800 text-white font-bold">Login</button>
                </div>
                <div class="flex justify-center"><a href="{{ route('register') }}" class="text-white mt-4 hover:underline text-center items-center">Don't have an account? Register</a></div>

            </form>

        </div>

    </div>
</body>
</html>
