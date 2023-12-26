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
              <form action="{{route('dashboard')}}">
                  <i class='bx bx-home' onclick="event.preventDefault();
                              this.closest('form').submit();" :active="request()->routeIs('dashboard')"></i>
                  <a href="{{route('dashboard')}}" onclick="event.preventDefault();
                              this.closest('form').submit();">
                      Главная
                  </a>
              </form>
              <form>
                  <i class='bx bx-user' onclick="window.location.href = '{{ route('admin.index',  Auth::user()->id) }}';"></i>
                  <a href="{{ route('admin.index',  Auth::user()->id) }}">
                      Мой блог
                  </a>
              </form>
              @if(auth()->check() && auth()->user()->ismoderator)
              <form>
                  <i class='bx bx-briefcase' onclick="window.location.href = '{{route('moderate.comments')}}';"></i>
                  <a href="{{route('moderate.comments')}}">
                      Модерация
                  </a>
              </form>
              @endif
                <form action="{{route('profile.edit')}}">
                    <i class='bx bx-cog' onclick="window.location.href = '{{route('profile.edit')}}';"></i>
                    <a href="{{route('profile.edit')}}">
                        Настройки
                    </a>
                </form>
                  <form class="logoutbtn" method="POST" action="{{ route('logout') }}">
                      @csrf
                      <i class='bx bx-log-out-circle'
                              onclick="event.preventDefault();
                                          this.closest('form').submit();"></i>
                      <a onclick="event.preventDefault();
                                          this.closest('form').submit();">
                          Выход
                      </a>
                  </form>
            </nav>
        </div>
        <script type="text/javascript">
            const toggleSidebar = () => document.body.classList.toggle("open");
        </script>
</nav>
