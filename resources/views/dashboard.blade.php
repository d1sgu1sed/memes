<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  @forelse($posts as $post)
  <?php $userLiked = $post->likes()->where('user_id', auth()->id())->exists(); ?>
      @if($post->isPublished() || auth()->user()->id === $post->user->id)
      <div class="container_for_posts">
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
      @endif
  @empty
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                Нет доступных постов
            </div>
        </div>
    </div>
  @endforelse
</div>
</x-app-layout>
