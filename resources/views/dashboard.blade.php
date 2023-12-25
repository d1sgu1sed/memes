<x-app-layout>
  <div class="card-body">
      @forelse($posts as $post)
          @if($post->isPublished() || auth()->user()->id === $post->user->id)
          <div class="card mb-4">
              <div class="card-body">
              <h5 class="card-title">
                  <a href="{{ route('user.show', $post->user) }}">
                      {{ $post->user->id === auth()->id() ? 'Вы' : $post->user->name }}
                  </a>
              </h5>
                  <h2 class="card-subtitle mb-2 text-muted"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}{{$post->isPublished() ? ' ' : ' ⏰ '.$post->published_at }}</a></h2>
                  <pre class="card-text">{!! $post->content !!}</pre>
                  @auth
                      @if($post->user->id === auth()->id())
                          <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Редактировать</a>
                          <form action="{{ route('posts.destroy', $post) }}" method="post" style="display: inline-block;">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">Удалить</button>
                          </form>
                      @endif
                  @endauth
              </div>
          </div>
          @endif
      @empty
          <p>Нет доступных постов.</p>
      @endforelse


      <div class="d-flex justify-content-center">
          {{$posts->links('pagination::bootstrap-4')}}
      </div>

  </div>
</x-app-layout>
