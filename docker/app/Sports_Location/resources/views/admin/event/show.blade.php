@extends('layouts.app_admin')

@section('content')
<div class="container">

  @if($event->status == '0' || empty($event->user->username) || $event->deadline < \Carbon\Carbon::now() || $event->number <= $number)
  <div class="row mb-3 align-items-center text-white bg-danger">
    <div class="text-center p-3">募集は終了しました。</div>
  </div>
  @endif

  <div class="row my-5">
    <div class="col-md-6 col-lg-4 offset-lg-1 text-center mb-3">
      @if(!empty($event->event_image))
      <img src="{{ asset($event->event_image) }}" class="event_image">
      @else
      <img src="{{ asset('images/no-image.png') }}" class="event_image">
      @endif
    </div>

    <div class="col-md-6 my-auto">
      @if(!empty($event->user->username))
      <div class="mb-3">開催者：<a href="{{ route('admin.user.show', ['username'=>$event->user->username]) }}">{{ $event->user->username }}</a></div>
      @else
      <div class="mb-3">開催者：退会済みユーザー</div>
      @endif

      <h3 class="mb-3">{{ $event->title }}</h3>
      <a href="{{ route('admin.events.edit', ['event'=>$event->id]) }}" class="col-8 offset-2 col-md-5 offset-md-0 mb-2 mb-md-0 btn btn-primary @if($event->deadline < Carbon\Carbon::now()) disabled @endif">編集する</a>
    </div>
  </div>

  <div class="row py-3 mb-3 border-top border-dark">
    <label for="genre" class="col-md-4 text-md-end fw-bold">{{ __('Genre') }}</label>

    <div class="col-md-6 offset-md-1">
      <a href="{{ route('admin.genre.show', ['genre_id'=>$event->genre->id]) }}">{{ $event->genre->genre_name }}</a>
    </div>
  </div>

  <div class="row pb-3 mb-3">
    <label for="area" class="col-md-4 text-md-end fw-bold">{{ __('Area') }}</label>

    <div class="col-md-6 offset-md-1">
      <a href="{{ route('admin.area.show', ['area_id'=>$event->area->id]) }}">{{ $event->area->name }}</a>
    </div>
  </div>

  <div class="row mb-3">
    <label for="location" class="col-md-4 text-md-end fw-bold">{{ __('Location') }}</label>

    <div class="col-md-6 offset-md-1">
      <p>{{ $event->location }}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="date" class="col-md-4 text-md-end fw-bold">{{ __('Date') }}</label>

    <div class="col-md-4 offset-md-1">
      <p>{{ $event->formatted_date }}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="start_time" class="col-md-4 text-md-end fw-bold">{{ __('Start_time') }}</label>

    <div class="col-md-4 offset-md-1">
      <p>{{ $event->formatted_start_time }}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="end_time" class="col-md-4 text-md-end fw-bold">{{ __('End_time') }}</label>

    <div class="col-md-4 offset-md-1">
      <p>{{ $event->formatted_end_time }}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="contents" class="col-md-4 text-md-end fw-bold">{{ __('Contents') }}</label>

    <div class="col-md-6 offset-md-1">
      <p>{!! nl2br(e($event->contents)) !!}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="condition" class="col-md-4 text-md-end fw-bold">{{ __('Condition') }}</label>

    <div class="col-md-6 offset-md-1">
      <p>{!! nl2br(e($event->condition)) !!}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="stuff" class="col-md-4 text-md-end fw-bold">{{ __('Stuff') }}</label>

    <div class="col-md-6 offset-md-1">
      <p>{!! nl2br(e($event->stuff)) !!}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="attention" class="col-md-4 text-md-end fw-bold">{{ __('Attention') }}</label>

    <div class="col-md-6 offset-md-1">
      <p>{!! nl2br(e($event->attention)) !!}</p>
    </div>
  </div>

  <div class="row mb-3">
    <label for="number" class="col-md-4 text-md-end fw-bold">{{ __('Number') }}</label>

    <div class="col-md-4 offset-md-1">
      <p>{{ $event->number }}名</p>
    </div>
  </div>

  <div class="row mb-4 border-bottom border-dark">
    <label for="deadline" class="col-md-4 text-md-end fw-bold">{{ __('Deadline') }}</label>

    <div class="col-md-4 offset-md-1">
      <p>{{ $event->formatted_deadline }}</p>
    </div>
  </div>

  <div class="row justify-content-center">
    <a href="{{ route('admin.events.index') }}" class="col-8 col-md-4 btn btn-dark">イベント一覧へ戻る</a>
  </div>

</div>
@endsection
