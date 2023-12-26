<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  @forelse($posts as $post)
      @if($post->isPublished() || auth()->user()->id === $post->user->id)
      <div class="post" id="post">
        <a href="#">
          <img src="{{ asset('/storage/' . $post->image)}}">
        </a>
          <div class="bottom">
              <div class="bottomLeft">
                  <form class="likes" action="index.html" method="post">
                    <div>

                    <button type="button" name="button">
                      <i class='bx bx-heart bx-tada-hover'></i>
                    </button>
                      <span id="coments">15</span>
                    </div>
                  </form>

                  <a href="#">
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
      <p>Нет доступных постов.</p>
  @endforelse
</x-app-layout>
