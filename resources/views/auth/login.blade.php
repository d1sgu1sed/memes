<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login | Registration</title>
    @vite(['resources/css/reg.css', 'resources/js/app.js'])
</head>

<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Создать аккаунт</h1>
                <span>используй почту для регистрации</span>
                <div class="input-container">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Имя"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="input-container">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Почта"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-container">
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="Пароль"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="input-container">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Подтвердите пароль"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <x-primary-button>
                    {{ __('зарегистрироваться') }}
                </x-primary-button>
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
