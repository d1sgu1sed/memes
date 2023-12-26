<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  <div class="container">
    {{Auth::id();}}
    @if(count($posts)!= 0)
      <h2>Блог пользователя</h2>
    @endif
    @forelse($posts as $post)
    <?php $userLiked = $post->likes()->where('user_id', auth()->id())->exists(); ?>
    @if($post->isPublished() || auth()->user()->id === $post->user->id)
    <div class="post" id="post">
      <a href="{{route('posts.show', $post)}}">
        <img src="{{ asset('/storage/' . $post->image)}}">
      </a>
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

                <a href="{{route('posts.show', $post)}}">
                  <span>&#128173;</span>
                  <span id="comments">{{count($post->comments)}}</span>
                </a>
            </div>
            <div class="bottomName">
              @if($post->user->id === auth()->id())
              <a href="{{ route('admin.index', $post->user) }}">
                  Вы
              </a>
              @else
              <a href="{{ route('posts.show', $post->user) }}">
                  {{$post->user->name}}
              </a>
              @endif
            </div>
        </div>
    </div>
    @endif
    @empty
        <p>Пользователь не создал постов.</p>
    @endforelse
  </div>
</x-app-layout>
