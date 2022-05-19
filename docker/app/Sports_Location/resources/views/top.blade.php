@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row" style="height:120px;">
    <div class="top-image">
      <p>スポーツで繋がろう！<br>盛り上がろう！</p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-3 mb-3">
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

    <div class="col-md-3 mb-3">
      <h4 class="fw-bold">新着募集情報</h4>
    </div>

    <div class="col-md-8 ms-md-3">
    @foreach($events as $event)
      <div class="row mb-3">
        @if(isset($event->event_image))
        <img class="col-8 offset-2 col-md-5 col-lg-3 offset-md-0 me-2 img-fluid" src="{{ asset($event->event_image) }}" style="border-radius:30%;max-height:120px;">
        @else
        <img class="col-8 offset-2 col-md-5 col-lg-3 offset-md-0 me-2 img-fluid" src="{{ asset('images/no-image.png') }}" style="border-radius:30%;max-height:120px;">
        @endif

        <div class="col-9 col-md-12 col-lg-8 offset-2 offset-md-0">
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
    </div>

  </div>

  <div class="row mb-3">
    <a href="{{ route('events.index') }}" class="col-8 offset-2 col-md-4 offset-md-4 btn btn-primary">募集イベント一覧</a>
  </div>

</div>
@endsection
