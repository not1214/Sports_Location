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
        <h3>応募申請詳細</h3>
      </div>
      <div class="row mb-3">
        @if(isset($reservation->user->profile_image))
        <img class="col-md-1 me-2" src="{{ asset($reservation->user->profile_image) }}" style="border-radius:50%;">
        @else
        <img class="col-md-1 me-2" src="{{ asset('images/no-image.png') }}">
        @endif
        <div class="col-md-8">
          <a href="{{ route('user.show', ['username'=>$reservation->user->username]) }}" class="fs-4 fw-bold">{{ $reservation->user->username }}</a>
        </div>
      </div>
      <div class="row">
        <label>コメント：</label>
        <p>{!! nl2br(e($reservation->comment)) !!}</p>
      </div>
      <form action="{{ route('events.reservations.update', ['event'=>$event->id, 'reservation'=>$reservation->id]) }}" method="post" name="update">
      @method('patch')
      @csrf
        <div class="row mb-3">
          <div class="col-md-5">
            <select id="permission" class="form-select" name="permission" required>
              @foreach(App\Models\Reservation::PERMISSION as $key => $val)
              <option value="{{ $key }}" {{ $key == old('permission', $reservation->permission) ? 'selected' : '' }}>{{ $val }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div>
            <label for="reply">返信コメント：</label>
            <textarea id="reply" name="reply" class="form-control mb-5"></textarea>
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" name="update" class="col-md-3 btn btn-primary">更新する</button>
          <a href="{{ route('events.reservations.index', ['event'=>$event->id]) }}" class="col-md-3 offset-md-1 btn btn-dark">一覧へ戻る</a>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection
