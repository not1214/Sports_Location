@extends('layouts.app')

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
      <a href="{{ route('user.edit') }}" class="col-8 offset-2 col-md-10 offset-md-1 mb-5 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
    </div>

    <div class="col-10 offset-1 col-md-8 offset-md-0">
      <div class="row mb-3">
        <h3>予約イベント一覧</h3>
      </div>

      @foreach ($reservations as $reservation)
      <div class="row mb-3">
        @if(isset($reservation->event->event_image))
        <img class="col-6 col-md-5 col-lg-3 order-1 img-fluid" src="{{ asset($reservation->event->event_image) }}" style="border-radius:30%;max-height:120px;">
        @else
        <img class="col-6 col-md-5 col-lg-3 order-1 img-fluid" src="{{ asset('images/no-image.png') }}" style="border-radius:30%;max-height:120px;">
        @endif

        <div class="col-5 col-md-4 col-lg-3 order-2 order-lg-3 d-flex align-items-center justify-content-end">
          <a href="{{ route('events.reservations.show', ['event'=>$reservation->event_id, 'reservation'=>$reservation->reservation_id]) }}" class="btn btn-primary">詳細</a>
        </div>

        <div class="col-10 col-md-12 col-lg-6 order-3 order-lg-2">
          <div class="col-12">
            <a href="{{ route('events.show', ['event'=>$reservation->event_id]) }}" class="fs-3 fw-bold">{{ $reservation->event->title }}</a>
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

      </div>
      @endforeach

      <div class="row mb-3">
        <div class="d-flex justify-content-center">{{ $reservations->links() }}</div>
      </div>
    </div>

  </div>
</div>
@endsection
