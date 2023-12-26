<x-app-layout>
  @vite(['resources/css/mainpage/moderaciacss.css', 'resources/css/mainpage/sidebarburger.css'])
      <h1>МОДЕРАЦИЯ</h1>

      <div class="modefield">
          <div class="item">
              <span>HEHEHEHEHEH</span>
              <form method="POST" action="" class="kot">
                  <button type="button" class="catsmile">КОТОСМАЙЛ</button>
              </form>
              <form method="POST" action="" class="">
                  <button type="button" class="bonk">ВЫДАТЬ БОНЬК!</button>
              </form>
          </div>

      </div>

      <script type="text/javascript">
          const toggleSidebar = () => document.body.classList.toggle("open");
      </script>
</x-app-layout>
