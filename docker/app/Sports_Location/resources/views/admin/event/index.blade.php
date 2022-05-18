@extends('layouts.app_admin')

@section('content')
<div class="container">
  <div class="row">
    
    <div class="col-md-3">
      <div class="row">
        <div class="text-center border-top border-end border-start border-dark p-1">
          <div class="p-1">ジャンル</div>
        </div>
        <div class="border border-dark p-3">
          <ul class="list-unstyled">
            @foreach($genres as $genre)
              <a href="{{ route('admin.genre.show', ['genre_id'=>$genre->id]) }}"><li>{{ $genre->genre_name }}</li></a>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    
    <div class="col-md-8 ms-5">
      <h3>イベントを探す</h3>
      <div class="row mb-3 p-2" style="background-color:#FFFFCC;">
        <form action="{{ route('admin.events.index') }}" method="get">
        @csrf
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="row">
                <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Genre') }}</label>
                <div class="col-md-7">
                  <select id="genre" class="form-select" name="genre">
                    <option value="" style='display:none;' @if(empty($genre_id)) selected @endif>選択してください</option>
                    @foreach($genres as $genre)
                      <option value="{{ $genre->id }}" @if(!empty($genre_id)) @if($genre_id == $genre->id) selected @endif @endif>{{ $genre->genre_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
                <label for="area" class="col-md-3 col-form-label text-md-end">{{ __('Area') }}</label>
                <div class="col-md-7">
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

          <div class="row mb-2">
            <label for="keyword" class="col-md-2 col-form-label text-md-end">キーワード</label>
            <div class="col-md-9">
              <input id="keyword" type="text" class="form-control" name="keyword" value="@if(!empty($keyword)) {{ $keyword }} @endif">
            </div>
          </div>

          <div class="row mb-2 justify-content-center">
            <button type="submit" class="btn btn-info col-md-2">{{ __('Search') }}</button>
          </div>
        </form>
      </div>
      
      <div class="row">
        <h3>イベント一覧</h3>
        @foreach ($events as $event)
          <div class="row mb-3">
            @if(isset($event->event_image))
              <img class="event-index-image col-md-2 me-2" src="{{ asset($event->event_image) }}">
            @else
              <img class="event-index-image col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
            @endif
            <div class="col-md-8">
              <div class="col-12">
                <a href="{{ route('admin.events.show', ['event'=>$event->id]) }}" class="fs-3 fw-bold">{{ $event->title }}</a>
              </div>
              <div class="col-12">
                @if (!empty($event->user->username))
                開催者：<span><a href="{{ route('admin.user.show', ['username'=>$event->user->username]) }}">{{ $event->user->username }}</a></span>
                @else
                開催者：<span>退会済みユーザー</a></span>
                @endif
              </div>
              <div class="col-12">
                エリア：<span><a href="{{ route('admin.area.show', ['area_id'=>$event->area->id]) }}">{{ $event->area->name }}</a></span>
              </div>
              <div class="col-12">
                ジャンル：<span><a href="{{ route('admin.genre.show', ['genre_id'=>$event->genre->id]) }}">{{ $event->genre->genre_name }}</a></span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row">
        <div class="d-flex justify-content-center">{{ $events->links() }}</div>
      </div>
    </div>

  </div>
</div>
@endsection
