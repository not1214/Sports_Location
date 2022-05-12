@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="row text-center mb-3">
        <div>
          <a href="{{ route('events.create') }}" class="btn btn-info">イベントを作成する</a>
        </div>
      </div>
      <div class="row">
        <div class="text-center border-top border-end border-start border-dark p-1">
          <div class="p-1">ジャンル</div>
        </div>
        <div class="border border-dark p-3">
          <ul class="list-unstyled">
            @foreach($genres as $genre)
              <a href="#"><li>{{ $genre->genre_name }}</li></a>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-8 ms-5">
      <h3>イベントを探す</h3>
      <h3>イベント一覧</h3>
      @foreach ($events as $event)
        <div class="row mb-3">
          @if(isset($event->event_image))
            <img class="col-md-2 me-2" src="{{ asset($event->event_image) }}" style="border-radius:30%;">
          @else
            <img class="col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
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
              エリア：<span><a href="#">{{ $event->area->name }}</a></span>
            </div>
            <div class="col-12">
              ジャンル：<span><a href="#">{{ $event->genre->genre_name }}</a></span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
