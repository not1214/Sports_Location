@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    
    <div class="col-md-3 me-3 text-center">
      @if(isset($user->profile_image))
        <img src="{{ asset($user->profile_image) }}" class="profile-image">
      @else
        <img src="{{ asset('images/no-image(user).jpg') }}" class="profile-image">
      @endif
        <h4 class="mt-3">{{ $user->username }}</h4>
      @if($follow)
        <a href="{{ route('user.unFollow', ['username'=>$user->username]) }}" class="col-10 btn btn-primary mt-5"><i class="fa-solid fa-user-check"></i></a>
      @else
        <a href="{{ route('user.follow', ['username'=>$user->username]) }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-plus"></i></a>
      @endif
    </div>
    
    <div class="col-md-8">
      <div class="row">
        <h3>作成イベント一覧</h3>
        @foreach ($events as $event)
          <div class="row mb-3">
            @if(isset($event->event_image))
              <img class="event-index-image col-md-2 me-2" src="{{ asset($event->event_image) }}" style="border-radius:30%;">
            @else
              <img class="event-index-image col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
            @endif
            <div class="col-md-8">
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
      
      <div class="row">
        <div class="d-flex justify-content-center">{{ $events->links() }}</div>
      </div>
    </div>

  </div>
</div>
@endsection
