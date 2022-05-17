@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 me-3">
      <div class="row text-center mb-2">
        @if(isset($event->event_image))
        <img src="{{ asset($event->event_image) }}" class="event-image" style="border-radius:50%;">
        @else
        <img src="{{ asset('images/no-image.jpg') }}" class="event-image" style="border-radius:50%;">
        @endif
        <h4 class="mt-3">{{ $event->title }}</h4>
      </div>
      <div class="row mb-1">
        <div class="col-md-4">{{ __('Genre') }}：</div>
        <div class="col-md-7 offset-md-1">{{ $event->genre->genre_name }}</div>
      </div>
      <div class="row mb-1">
        <div class="col-md-4">{{ __('Location') }}：</div>
        <div class="col-md-7 offset-md-1">{{ $event->location }}</div>
      </div>
      <div class="row mb-1">
        <div class="col-md-4">{{ __('Date') }}：</div>
        <div class="col-md-7 offset-md-1">{{ $event->formatted_date }}</div>
      </div>
      <div class="row mb-1">
        <div class="col-md-4">{{ __('Start_time') }}：</div>
        <div class="col-md-7 offset-md-1">{{ $event->formatted_start_time }}</div>
      </div>
      <div class="row mb-1">
        <div class="col-md-4">{{ __('End_time') }}：</div>
        <div class="col-md-7 offset-md-1">{{ $event->formatted_end_time }}</div>
      </div>
    </div>
    
    <div class="col-md-7">
      <div class="row mb-3 mt-3 mt-md-0">
        <h3>応募申請</h3>
      </div>
      <form action="{{ route('events.reservations.store', ['event'=>$event->id]) }}" method="post" name="form">
      @csrf
        <div class="row mb-5">
          <label for="comment">コメント</label>
          <textarea id="comment" name="comment" class="form-control"></textarea>
          @error('comment')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="row justify-content-center">
          <button type="submit" name="apply" class="col-md-3 btn btn-primary">応募する</button>
          <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="col-md-3 offset-md-1 btn btn-danger">キャンセル</a>
        </div>
      </form>
    </div>

  </div>
</div>

@endsection