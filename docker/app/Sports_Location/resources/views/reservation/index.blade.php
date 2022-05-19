@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-4 me-3">
      <div class="row mb-2">
        @if(isset($event->event_image))
        <img src="{{ asset($event->event_image) }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
        @else
        <img src="{{ asset('images/no-image.jpg') }}" class="col-10 offset-1 col-md-12 offset-md-0 event_image">
        @endif
        <h4 class="col-10 offset-1 col-md-12 offset-md-0 mt-3"><a href="{{ route('events.show', ['event'=>$event->id]) }}">{{ $event->title }}</a></h4>
      </div>

      <div class="row mb-1">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('Genre') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->genre->genre_name }}</div>
      </div>

      <div class="row mb-1">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('Location') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->location }}</div>
      </div>

      <div class="row mb-1">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('Date') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->formatted_date }}</div>
      </div>

      <div class="row mb-1">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('Start_time') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->formatted_start_time }}</div>
      </div>

      <div class="row mb-1">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('End_time') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->formatted_end_time }}</div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="row mb-3 mt-3 mt-md-0">
        <h3>応募申請一覧（{{ count($reservations) }}件）</h3>
      </div>

      @foreach($reservations as $reservation)
        <div class="row mb-3 pb-1 border-bottom">
          @if(isset($reservation->user->profile_image))
          <img class="col-2 col-md-2 col-lg-1 me-2" src="{{ asset($reservation->user->profile_image) }}" style="border-radius:50%;max-height:40px;">
          @else
          <img class="col-2 col-md-2 col-lg-1 me-2" src="{{ asset('images/no-image.png') }}" style="border-radius:50%;max-height:40px;">
          @endif
          <div class="col-9 col-md-9">
            <div class="row">
              <a href="{{ route('user.show', ['username'=>$reservation->user->username]) }}" class="col-5 col-md-6 fs-5 fw-bold">{{ $reservation->user->username }}</a>
              <div class="col-4 col-md-3 pt-2">{{ $reservation->permission_text }}</div>
              <a href="{{ route('events.reservations.edit', ['event'=>$event->id, 'reservation'=>$reservation->id]) }}" class="col-3 col-md-3 btn btn-primary">詳細</a>
            </div>
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