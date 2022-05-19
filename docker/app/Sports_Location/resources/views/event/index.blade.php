@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3 order-2 order-md-1">

      <div class="row mb-5 justify-content-center">
        <a href="{{ route('events.create') }}" class="btn btn-info col-8 col-md-auto">イベントを作成する</a>
      </div>

      <div class="row justify-content-center">
        <div class="col-10 col-md-12 text-center border-top border-end border-start border-dark p-1">
          <div class="p-1">ジャンル</div>
        </div>
        <div class="col-10 col-md-12 border border-dark p-3">
          <ul class="list-unstyled">
            @foreach($genres as $genre)
              <a href="{{ route('genre.show', ['genre_id'=>$genre->id]) }}"><li>{{ $genre->genre_name }}</li></a>
            @endforeach
          </ul>
        </div>
      </div>

    </div>

    <div class="col-10 offset-1 col-md-8 offset-md-0 ms-md-5 order-1 order-md-2">

      <div class="row mb-3">
        <h3>イベントを探す</h3>
      </div>

      <div class="row mb-3 p-2" style="background-color:#FFFFCC;">
        <form action="{{ route('events.index') }}" method="get">
        @csrf
          <div class="row mb-2">

            <div class="col-lg-6">
              <div class="row">
                <label for="genre" class="col-lg-4 col-form-label text-lg-end">{{ __('Genre') }}</label>
                <div class="col-lg-7">
                  <select id="genre" class="form-select" name="genre">
                    <option value="" style='display:none;' @if(empty($genre_id)) selected @endif>選択してください</option>
                    @foreach($genres as $genre)
                      <option value="{{ $genre->id }}" @if(!empty($genre_id)) @if($genre_id == $genre->id) selected @endif @endif>{{ $genre->genre_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="row">
                <label for="area" class="col-lg-3 col-form-label text-lg-end">{{ __('Area') }}</label>
                <div class="col-lg-8">
                  <select id="area" class="form-select" name="area">
                    <option value="" style='display:none;' @if(empty($area_id)) selected @endif>選択してください</option>
                    @foreach($areas as $area)
                      <option value="{{ $area->id }}" @if(!empty($area_id)) @if($area_id == $area->id) selected @endif @endif>{{ $area->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          </div>

          <div class="row mb-3">
            <label for="keyword" class="col-lg-2 col-form-label text-lg-end">キーワード</label>
            <div class="col-lg-10">
              <input id="keyword" type="text" class="form-control" name="keyword" value="@if(!empty($keyword)) {{ $keyword }} @endif">
            </div>
          </div>

          <div class="row mb-2 justify-content-center">
            <button type="submit" class="btn btn-info col-8 col-md-4 col-lg-2">{{ __('Search') }}</button>
          </div>
        </form>
      </div>

      <div class="row mb-3">
        <h3>イベント一覧</h3>
      </div>

      @foreach ($events as $event)
      <div class="row mb-3">
        @if(isset($event->event_image))
        <img class="col-8 offset-2 col-md-5 col-lg-3 offset-md-0 me-2 img-fluid" src="{{ asset($event->event_image) }}" style="border-radius:30%;max-height:120px;">
        @else
        <img class="col-8 offset-2 col-md-5 col-lg-3 offset-md-0 me-2 img-fluid" src="{{ asset('images/no-image.png') }}" style="border-radius:30%;max-height:120px;">
        @endif

        <div class="col-10 offset-1 col-md-12 col-lg-8 offset-md-0">
          <div class="col-12">
            <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="fs-3 fw-bold">{{ Str::limit($event->title, 30) }}</a>
          </div>

          <div class="col-12">
            @if (!empty($event->user->username))
            開催者：<span><a href="{{ route('user.show', ['username'=>$event->user->username]) }}">{{ $event->user->username }}</a></span>
            @else
            開催者：<span>退会済みユーザー</a></span>
            @endif
          </div>

          <div class="col-12">
            エリア：<span><a href="{{ route('area.show', ['area_id'=>$event->area->id]) }}">{{ $event->area->name }}</a></span>
          </div>

          <div class="col-12">
            ジャンル：<span><a href="{{ route('genre.show', ['genre_id'=>$event->genre->id]) }}">{{ $event->genre->genre_name }}</a></span>
          </div>
        </div>
      </div>
      @endforeach

      <div class="row mb-3">
        <div class="d-flex justify-content-center">{{ $events->links() }}</div>
      </div>

    </div>

  </div>
</div>
@endsection
