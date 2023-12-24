  <nav class="sidebar" id="bar">
    @vite(['resources/css/mainpage/style.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <div class="sidebar-inner">
            <header class="sidebar-header">
                <button type="button" class="sidebar-burger" onclick="toggleSidebar()">
                     <i class='bx bx-menu'></i>
                </button>
                <img src="https://i.ibb.co/GTc8jqb/HEHEMEME.png" alt="HEHEMEME" class="sidebar-logo">
            </header>

            <nav class="sidebar-menu">
              <form method="GET" action="{{route('dashboard')}}">
                  <i class='bx bx-home' onclick="event.preventDefault();
                              this.closest('form').submit();" :href="route('dashboard')" :active="request()->routeIs('dashboard')"></i>
                  <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                      {{ __('Главная') }}
                  </x-nav-link>
              </form>
              <form method="GET" action="{{route('profile.edit')}}">
                  <i class='bx bx-user' onclick="event.preventDefault();
                              this.closest('form').submit();"></i>
                  <x-dropdown-link :href="route('profile.edit')">
                      {{ __('Мой блог') }}
                  </x-dropdown-link>
              </form>
                <form method="GET" action="{{route('profile.edit')}}">
                    <i class='bx bx-cog' onclick="event.preventDefault();
                                this.closest('form').submit();"></i>
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Настройки') }}
                    </x-dropdown-link>
                </form>
                  <form class="logoutbtn" method="POST" action="{{ route('logout') }}">
                      @csrf
                      <i class='bx bx-log-out-circle' :href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();"></i>
                      <x-dropdown-link :href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Выход') }}
                      </x-dropdown-link>
                  </form>
            </nav>
        </div>
        <script type="text/javascript">
            const toggleSidebar = () => document.body.classList.toggle("open");
        </script>
</nav>
