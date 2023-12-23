<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Modern Login Page | AsmrProg</title>
    @vite(['resources/css/css.css', 'resources/js/app.js'])
</head>

<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Создать аккаунт</h1>
                <span>используй почту для регистрации</span>
                <input type="text" placeholder="Имя">
                <input type="email" placeholder="Почта">
                <input type="password" placeholder="Пароль">
                <input type="password" placeholder="Подтвердите пароль">
                <button>зарегистрироваться</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
              @csrf
                <h1>Войти</h1>
                <span>используйте почту для входа</span>
                <div class="input-container">
                    <x-text-input id="email" placeholder="Почта" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-container">
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="Пароль"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Забыли пароль?') }}
                    </a>
                @endif
                <x-primary-button>
                    {{ __('Войти') }}
                </x-primary-button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Добро пожаловать!</h1>
                    <p>Зарегистрируйтесь, указав свои личные данные, чтобы использовать все функции сайта.</p>
                    <button class="hidden" id="login">Войти</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Привет!</h1>
                    <p>Введите свои личные данные, чтобы использовать все возможности сайта</p>
                    <button class="hidden" id="register">зарегистрироваться</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>
