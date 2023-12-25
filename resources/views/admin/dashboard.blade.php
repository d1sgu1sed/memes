<x-app-layout>
  <div class="container">
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
</x-app-layout>
