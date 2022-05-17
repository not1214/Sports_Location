@extends('layouts.app')

@section('content')
<div class="container">
  
  <div class="row" style="height:120px;">
    <div class="top-image">
      <p>スポーツで繋がろう！<br>盛り上がろう！</p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-3">
      <h4 class="fw-bold">スポロケとは</h4>
    </div>
    <div class="col-md-8 ms-md-3">
      <p>
        スポーツ仲間を作ることができるSNSサイトです。<br>
        会員登録していただくと、個人参加型フットサルの参加や
        チームメンバーの募集をすることができます。
      </p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-3">
      <h4 class="fw-bold">新着募集情報</h4>
    </div>
    <div class="col-md-8 ms-md-3">
      @foreach($events as $event)
        <div class="row mb-3">
          @if(isset($event->event_image))
            <img class="event-index-image col-md-2 me-2" src="{{ asset($event->event_image) }}" style="border-radius:30%;">
          @else
            <img class="event-index-image col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
          @endif
          <div class="col-md-8">
            <div class="col-12">
              <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="fs-3 fw-bold">{{ $event->title }}</a>
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
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-2 offset-md-5">
      <a href="{{ route('events.index') }}" class="btn btn-primary">募集イベント一覧</a>
    </div>
  </div>
</div>
@endsection
