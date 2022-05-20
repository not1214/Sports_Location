@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3 me-md-5">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @endif
      <h4 class="mt-3 text-center">{{ $user->username }}</h4>
      <a href="{{ route('admin.user.edit', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 mb-5 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
    </div>

    <div class="col-10 offset-1 col-md-8 offset-md-0">
      <div class="row mb-3">
        <h3>参加済みイベント一覧</h3>
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
            <a href="{{ route('admin.events.show', ['event'=>$event->id]) }}" class="fs-3 fw-bold">{{ Str::limit($event->title, 30) }}</a>
          </div>

          <div class="col-12">
            @if (!empty($event->user->username))
            開催者：<span><a href="{{ route('admin.user.show', ['username'=>$user->username]) }}">{{ $event->user->username }}</a></span>
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
