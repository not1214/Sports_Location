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
      @if(Auth::id() == $user->id )
      <a href="{{ route('user.edit') }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-pen"></i></a>
      @endif
    </div>

    <div class="col-md-8">
      <div class="row mb-3">
        <h3>予約イベント一覧</h3>
      </div>
      @foreach ($reservations as $reservation)
      <div class="row mb-3">
        @if(isset($reservation->event->event_image))
        <img class="event-index-image col-md-2 me-2" src="{{ asset($reservation->event->event_image) }}" style="border-radius:30%;">
        @else
        <img class="event-index-image col-md-2 me-2" src="{{ asset('images/no-image.png') }}">
        @endif
        <div class="col-md-7">
          <div class="col-12">
            <a href="{{ route('events.show', ['event'=>$reservation->event->id]) }}" class="fs-3 fw-bold">{{ $reservation-> }}</a>
          </div>
          <div class="col-12">
            @if (!empty($reservation->event->user->username))
            開催者：<span><a href="{{ route('user.show', ['username'=>$reservation->event->user->username]) }}">{{ $reservation->event->user->username }}</a></span>
            @else
            開催者：<span>退会済みユーザー</a></span>
            @endif
          </div>
          <div class="col-12">
            エリア：<span><a href="{{ route('area.show', ['area_id'=>$reservation->event->area->id]) }}">{{ $reservation->event->area->name }}</a></span>
          </div>
          <div class="col-12">
            ジャンル：<span><a href="{{ route('genre.show', ['genre_id'=>$reservation->event->genre->id]) }}">{{ $reservation->event->genre->genre_name }}</a></span>
          </div>
        </div>
        <div class="col-md-2 d-flex align-items-center">
          <a href="{{ route('events.reservations.show', ['event'=>$reservation->event->id, 'reservation'=>$reservation->id]) }}" class="btn btn-primary">詳細</a>
        </div>
      </div>
      @endforeach
      <div class="row">
        <div class="d-flex justify-content-center">{{ $reservations->links() }}</div>
      </div>
    </div>

  </div>
</div>
@endsection