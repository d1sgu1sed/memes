<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  <div class="container_for_posts">
      @if($user->id === auth()->id())
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <span style="font-size: 16pt;text-transform: uppercase;">ваши посты</span>
                </div>
            </div>
        </div>
      @else
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <span style="font-size: 16pt; text-transform: uppercase;">посты пользователя {{__($user->name)}}</span>
                </div>
            </div>
        </div>
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
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin:40px 0 ;">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                Нет доступных постов
            </div>
        </div>
    </div>
  @endforelse
    @if($user->id === auth()->id())
      <form action="{{ route('posts.create') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="title">Заголовок</label>
              <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
              <label for="content">Содержание</label>
              <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
          </div>
          <div class="">
            <label for="content">Картинка</label>
            <input type="file"class="form-control" id="image" name="image" required></input>
          </div>
          <button type="submit" class="btn btn-primary">Создать пост</button>
      </form>
    </div>
    @endif
</x-app-layout>
