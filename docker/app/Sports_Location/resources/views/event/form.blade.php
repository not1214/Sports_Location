<div class="container">

  @if($target == 'confirm')
  <h3 class="text-center mb-3">イベントを作成</h3>
  <form method="post" action="/events/create/confirm" enctype="multipart/form-data" name="form">
  @elseif($target == 'update')
  <h3 class="text-center mb-3">イベントを編集</h3>
  <form method="post" action="/events/{{ $event->id }}/edit/confirm" enctype="multipart/form-data" name="form">
  @endif
    @csrf

    <div class="row mb-3">
      <label for="image" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Image') }}</label>

      <div class="col-md-6">
        <input id="image" type="file" class="form-control" name="image">
      </div>
      @error('image')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="title" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Title') }}</label>

      <div class="col-md-6">
        <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $event->title) }}">
      </div>
      @error('title')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="genre" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Genre') }}</label>

      <div class="col-md-4">
        <select id="genre" class="form-select" name="genre">
          <option disabled style='display:none;' @if (empty($event->genre_id)) selected @endif>選択してください</option>
          @foreach($genres as $genre)
            <option value="{{ $genre->id }}" @if (old('genre', $event->genre_id) == $genre->id)) selected @endif>{{ $genre->genre_name }}</option>
          @endforeach
        </select>
      </div>
      @error('genre')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="area" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Area') }}</label>

      <div class="col-md-4">
        <select id="area" class="form-select" name="area">
          <option disabled style='display:none;' @if (empty($event->area_id)) selected @endif>選択してください</option>
          @foreach($areas as $area)
            <option value="{{ $area->id }}" @if (old('area', $event->area_id) == $area->id)) selected @endif>{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
      @error('area')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="location" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Location') }}</label>

      <div class="col-md-6">
        <input id="location" type="text" class="form-control" name="location" value="{{ old('location', $event->location) }}">
      </div>
      @error('location')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="date" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Date') }}</label>

      <div class="col-md-4">
        <input id="date" type="date" class="form-control" name="date" value="{{ old('date', $event->date) }}">
      </div>
      @error('date')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="start_time" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Start_time') }}</label>

      <div class="col-md-4">
        <input id="start_time" type="time" class="form-control" name="start_time" value="{{ old('start_time', $event->start_time) }}">
      </div>
      @error('start_time')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="end_time" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('End_time') }}</label>

      <div class="col-md-4">
        <input id="end_time" type="time" class="form-control" name="end_time" value="{{ old('end_time', $event->end_time) }}">
      </div>
      @error('end_time')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="contents" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Contents') }}</label>

      <div class="col-md-6">
        <textarea id="contents" class="form-control" name="contents">{{ old('contents', $event->contents) }}</textarea>
      </div>
      @error('contents')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="condition" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Condition') }}</label>

      <div class="col-md-6">
        <textarea id="condition" class="form-control" name="condition">{{ old('condition', $event->condition) }}</textarea>
      </div>
      @error('condition')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="stuff" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Stuff') }}</label>

      <div class="col-md-6">
        <textarea id="stuff" class="form-control" name="stuff">{{ old('stuff', $event->stuff) }}</textarea>
      </div>
      @error('stuff')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="attention" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Attention') }}</label>

      <div class="col-md-6">
        <textarea id="attention" class="form-control" name="attention">{{ old('attention', $event->attention) }}</textarea>
      </div>
      @error('attention')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="number" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Number') }}</label>

      <div class="col-md-4">
        <input id="number" type="number" class="form-control" name="number" min="1" value="{{ old('number', $event->number) }}">
      </div>
      @error('number')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="deadline" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Deadline') }}</label>

      <div class="col-md-4">
        <input id="deadline" type="datetime-local" class="form-control" name="deadline" value="{{ old('deadline', str_replace(" ", "T", $event->deadline)) }}">
      </div>
      @error('deadline')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    @if($target == 'confirm')
      <input id="status" name="status" type="hidden" value="1">
    @elseif($target == 'update')
      <div class="row mb-3">
        <label for="status" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Status') }}</label>

        <div class="col-md-6 d-flex align-items-center">
          <input id="status" type="radio" name="status" value="1" {{ old('status', $event->status) == '1' ? 'checked' : '' }}>募集中　　
          <input id="status" type="radio" name="status" value="0" {{ old('status', $event->status) == '0' ? 'checked' : '' }}>募集終了　　
        </div>
      </div>
    @endif

    <div class="row justify-content-center">
      <button type="submit" name="confirm" class="col-8 col-md-3 col-lg-2 me-md-2 btn btn-primary">
        {{ __('Confirm') }}
      </button>
      @if($target == 'confirm')
      <a href="/events" class="col-8 col-md-3 col-lg-2 mt-2 mt-md-0 btn btn-danger">イベント一覧へ戻る</a>
      @elseif($target == 'update')
      <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="col-8 col-md-3 col-lg-2 mt-2 mt-md-0 btn btn-danger">イベント詳細へ戻る</a>
      @endif
    </div>
  </form>

</div>
