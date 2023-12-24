<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/mainpage/startpage.css'])
</head>
<body>
    @if (Route::has('login'))
            @auth
            <form action="{{ url('/dashboard') }}">
              <button>Лента</button>
            </form>
            @else
            <form action="{{ route('login') }}">
              <button>Войти</button>
            </form>
            @endauth
    @endif
    <div class="startcenter">
        <h1>добро пожаловать на хехемеме!</h1>
        <p>блог со смешнявками</p>
        <img src="https://i.ibb.co/hBd61mS/image-1.png" alt="image-1">

    </div>
</body>
</html>
