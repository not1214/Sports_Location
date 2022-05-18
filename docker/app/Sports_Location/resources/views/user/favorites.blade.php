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
      <a href="{{ route('user.edit') }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-pen"></i></a>
    </div>
    
    <div class="col-md-8">
      <div class="row">
        <h3>お気に入りイベント一覧</h3>
        @foreach ($favorites as $favorite)
          <div class="row mb-3">
            @if(isset($favorite->event->event_image))
              <img class="col-md-2 me-2" src="{{ asset($favorite->event->event_image) }}" style="border-radius:30%;">
            @else
              <img class="col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
            @endif
            <div class="col-md-8">
              <div class="col-12">
                <a href="{{ route('events.show', ['event'=>$favorite->event_id]) }}" class="fs-3 fw-bold">{{ $favorite->event->title }}</a>
              </div>
              <div class="col-12">
                @if (!empty($favorite->user->username))
                開催者：<span><a href="{{ route('user.show', ['username'=>$favorite->event->user->username]) }}">{{ $favorite->event->user->username }}</a></span>
                @else
                開催者：<span>退会済みユーザー</a></span>
                @endif
              </div>
              <div class="col-12">
                エリア：<span><a href="{{ route('area.show', ['area_id'=>$favorite->event->area->id]) }}">{{ $favorite->event->area->name }}</a></span>
              </div>
              <div class="col-12">
                ジャンル：<span><a href="{{ route('genre.show', ['genre_id'=>$favorite->event->genre->id]) }}">{{ $favorite->event->genre->genre_name }}</a></span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row">
        <div class="d-flex justify-content-center">{{ $favorites->links() }}</div>
      </div>
    </div>

  </div>
</div>
@endsection
