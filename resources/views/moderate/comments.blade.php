<x-app-layout>
  @vite(['resources/css/mainpage/moderacia.css', 'resources/css/mainpage/sidebarburger.css'])
      <h1>МОДЕРАЦИЯ</h1>

      <div class="modefield">
      @forelse ($comments as $comment)
          <div class="item">
              <span onclick="window.location.href = '{{ route('posts.show', $comment->post) }}';">
                {{$comment->user->name}}: {{$comment->comment_text}}
              </span>
              <form action="{{ route('moderate.approveComment', $comment) }}" method="post" class="kot">
                @csrf
                @method('post')
                  <button type="submit" class="catsmile">КОТОСМАЙЛ</button>
              </form>
              <form action="{{ route('moderate.rejectComment', $comment) }}" method="post" class="">
                @csrf
                @method('post')
                  <button type="submit" class="bonk">ВЫДАТЬ БОНЬК!</button>
              </form>
          </div>

      @empty
              <span>Нет комментариев для модерации.</span>
      @endforelse
    </div>


      <script type="text/javascript">
          const toggleSidebar = () => document.body.classList.toggle("open");
      </script>
</x-app-layout>
