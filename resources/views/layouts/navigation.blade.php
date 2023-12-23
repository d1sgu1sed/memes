  <nav class="sidebar" id="bar">
    @vite(['resources/css/mainpage/style.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <div class="sidebar-inner">
            <header class="sidebar-header">
                <button type="button" class="sidebar-burger" onclick="toggleSidebar()">
                     <i class='bx bx-menu'></i>
                </button>
                <img src="https://i.ibb.co/GTc8jqb/HEHEMEME.png" alt="HEHEMEME" class="sidebar-logo">
            </header>

            <nav class="sidebar-menu">
                <button type="button">
                    <i class='bx bx-home' ></i>
                    <span>Home</span>
                </button>
                <button type="button">
                    <i class='bx bx-user' ></i>
                    <span>Accounts</span>
                </button>
                <button type="button">
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf

                      <x-dropdown-link :href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          {{ __('Log Out') }}
                      </x-dropdown-link>
                  </form>
                </button>
            </nav>
        </div>
        <script type="text/javascript">
            const toggleSidebar = () => document.body.classList.toggle("open");
        </script>
</nav>
