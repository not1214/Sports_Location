@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-4 me-3">
      <div class="row mb-2">
        @if(isset($event->event_image))
        <img src="{{ asset($event->event_image) }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
        @else
        <img src="{{ asset('images/no-image.png') }}" class="col-10 offset-1 col-md-12 offset-md-0 event_image">
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

      <div class="row mb-3">
        <div class="col-10 col-lg-4 offset-1 offset-md-0 fw-bold text-lg-end">{{ __('End_time') }}：</div>
        <div class="col-10 col-lg-6 offset-1">{{ $event->formatted_end_time }}</div>
      </div>

      <div class="row mb-3">
        <a href="{{ route('events.reviews.create', ['event'=>$event->id]) }}" class="col-8 offset-2 btn btn-primary @if(empty($joined_event)) disabled @endif">レビューを投稿</a>
      </div>
    </div>

    <div class="col-md-7">
      <div class="row mb-3 mt-3 mt-md-0">
        <h3>レビュー一覧</h3>
      </div>

      @foreach($reviews as $review)
      <div class="row mb-3 pb-1" style="background-color:#FFFFBB;">
        <div class="col-9">
          <div>{{ $review->comment }}</div>
          <div class="rating" data-rate="{{ $review->score }}"></div>
        </div>
        <div class="col-3 align-item-center">
          <a href="{{ route('events.reviews.show', ['event'=>$event->id, 'review'=>$review->id]) }}" class="btn btn-primary">詳細</a>
        </div>
      </div>
      @endforeach

    </div>

  </div>
</div>

@endsection