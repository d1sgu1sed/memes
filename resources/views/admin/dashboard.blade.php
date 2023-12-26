<x-app-layout>
  @vite(['resources/css/mainpage/postcss.css'])
  <div class="container_for_posts">
      @if($user->id === auth()->id())
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    Ваши посты
                </div>
            </div>
        </div>
      @else
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    Посты пользователя {{__($user->name)}}
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
          <div class="form-check">
              <input class="form-check-input" type="checkbox" id="schedule_post" name="schedule_post">
              <label class="form-check-label" for="schedule_post">Опубликовать в определённое время</label>
          </div>

          <div id="schedule_options" style="display: none;">
              <label for="published_at">Дата и время публикации:</label>
              <input type="datetime-local" id="published_at" name="published_at">
      </div>
          <button type="submit" class="btn btn-primary">Создать пост</button>
      </form>
    </div>
    @endif
</x-app-layout>
