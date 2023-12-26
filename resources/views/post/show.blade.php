<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css', 'resources/css/mainpage/postcomments.css', 'resources/css/mainpage/sidebarburger.css'])
  <?php $userLiked = $post->likes()->where('user_id', auth()->id())->exists(); ?>
  <div class="container">
  <div class="post" id="posttemplate">
      <img id = "my-img" src="{{ asset('/storage/' . $post->image)}}" onclick="attachImg()">
      <div class="bottom">
          <div class="bottomLeft">
            @if($userLiked)
                <form action="{{ route('posts.unlike', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                      <i class='bx bxs-heart bx-tada-hover'></i>
                      {{count($post->likes)}}
                    </button>
                </form>
            @else
                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                    @csrf

                    <button type="submit">
                      <i class='bx bx-heart bx-tada-hover'></i>
                      {{count($post->likes)}}
                    </button>
                </form>
            @endif
                <span>&#128173;</span>
                <span id="comments">{{count($post->comments)}}</span>
          </div>
          @auth
              @if($post->user->id === auth()->id())
                  <form action="{{ route('posts.destroy', $post) }}" method="post" style="display: inline-block;">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">&#10060;</button>
                  </form>
              @endif
          @endauth
          <div class="bottomName">
            <a href="{{ route('admin.index', $post->user) }}">
                {{ $post->user->id === auth()->id() ? 'Вы' : $post->user->name }}
            </a>
          </div>
      </div>
  </div>

  <div class="comments">
      <div class="postcaption">
          <h1 style='font-weight:bold;'>{{$post->title}}</h1>
          <span>{{$post->content}}</span>
      </div>
      <hr>
      <div class="com">
        @forelse($post->comments()->where('moderated', true)->where('approved', true)->paginate(15) as $comment)
          <span class="card-title">{{ $comment->user->id === auth()->id() ? 'Вы' : $comment->user->name }}: {{ $comment->comment_text }}</span>
        @empty
            <span>Нет одобренных комментариев.</span>
        @endforelse
      </div>
      <form method="post" action="{{ route('comments.store', $post) }}" class="containeraddcom">
        @csrf
          <input type="text" name="comment" id="comment" class="inputcomment" placeholder="добавить комментарий..." required>
          <button type="submit" class="addcom" onclick="alert('Дождитесь, пока комментарий будет одобрен модераторами!')"><i class='bx bx-send'></i></button>
      </form>
  </div>
</x-app-layout>
<script type="text/javascript">
  function attachImg(){
    const c = document.getElementById("my-img"); // берем картинку по id
    const d = c.src; // берем ее src
    const w = window.open('about:blank','new image'); // открываем окно
    w.document.write("<img src='" + d + "' alt='from old image' style='max-width: 70%; height: auto;' />");
  }
</script>
