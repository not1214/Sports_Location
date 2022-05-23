@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-4 me-3">
      <div class="row mb-2">
        @if(isset($event->event_image))
        <img src="{{ asset($event->event_image) }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
        @else
        <img src="{{ asset('images/no-image.jpg') }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
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
        <h3>応募申請</h3>
      </div>

      <form action="{{ route('events.reservations.store', ['event'=>$event->id]) }}" method="post" name="form">
        @csrf
        <div class="row mb-5">
          <label for="comment" class="col-10 offset-1 col-md-11 offset-md-0 fw-bold">コメント</label>
          <div class="col-10 offset-1 col-md-11 offset-md-0">
          <textarea id="comment" name="comment" class="form-control">{{ old('comment') }}</textarea>
            @error('comment')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <input type="hidden" value="開催者様は必要事項を記入し、返信してください。" name="reply">

        <div class="row justify-content-center">
          <button type="submit" name="apply" class="col-8 col-md-3 mb-2 mb-md-0 btn btn-primary">応募する</button>
          <a href="{{ route('events.show', ['event'=>$event->id]) }}" class="col-8 col-md-3 offset-md-1 btn btn-danger">キャンセル</a>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection
