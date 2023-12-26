<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  @forelse($posts as $post)
  <?php $userLiked = $post->likes()->where('user_id', auth()->id())->exists(); ?>
      @if($post->isPublished() || auth()->user()->id === $post->user->id)
      <div class="post" id="post">
        <a href="#">
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
                  <!-- <form class="likes" action="{{route('posts.like', $post->user)}}" method="post">
                    @csrf
                    <div>

                    <button type="submit" name="button">
                      <i class='bx bx-heart bx-tada-hover'></i>
                    </button>
                      <span id="likes">{{count($post->likes)}}</span>
                    </div>
                  </form> -->

                  <a href="{{route('posts.show', $post)}}">
                    <span>&#128173;</span>
                    <span id="comments">{{count($post->comments)}}</span>
                  </a>
              </div>
              <div class="bottomName">
                <a href="{{ route('user.show', $post->user) }}">
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
                "Нет доступных постов"
            </div>
        </div>
    </div>
  @endforelse
</x-app-layout>
