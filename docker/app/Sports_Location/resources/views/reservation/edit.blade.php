@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-4 me-3">
      <div class="row mb-2">
        @if(isset($event->event_image))
        <img src="{{ asset($event->event_image) }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
        @else
        <img src="{{ asset('images/no-image.png') }}" class="col-10 offset-1 col-md-8 offset-md-2 event_image">
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
        <h3>応募申請詳細</h3>
      </div>

      <div class="row mb-3">
        @if(isset($reservation->user->profile_image))
        <img class="col-2 offset-1 col-md-2 offset-md-0 col-lg-1 me-2" src="{{ asset($reservation->user->profile_image) }}" style="border-radius:50%;max-height:40px;">
        @else
        <img class="col-2 col-md-2 col-lg-1 me-2" src="{{ asset('images/no-image.png') }}" style="border-radius:50%;max-height:40px;">
        @endif
        <div class="col-7 col-md-8">
          <a href="{{ route('user.show', ['username'=>$reservation->user->username]) }}" class="fs-4 fw-bold">{{ $reservation->user->username }}</a>
        </div>
      </div>

      <div class="row">
        <label class="col-10 offset-1 col-md-11 offset-md-0 fw-bold">コメント：</label>
        <p class="col-10 offset-1 col-md-11 offset-md-0 text-break">{!! nl2br(e($reservation->comment)) !!}</p>
      </div>

      <form action="{{ route('events.reservations.update', ['event'=>$event->id, 'reservation'=>$reservation->id]) }}" method="post" name="update">
        @method('patch')
        @csrf
        <div class="row mb-3">
          <div class="col-10 offset-1 col-md-5 offset-md-0">
            <select id="permission" class="form-select" name="permission" required>
              @foreach(App\Models\Reservation::PERMISSION as $key => $val)
              <option value="{{ $key }}" {{ $key == old('permission', $reservation->permission) ? 'selected' : '' }}>{{ $val }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-5">
          <label for="reply" class="col-10 offset-1 col-md-11 offset-md-0 fw-bold">返信コメント：</label>
          <div class="col-10 offset-1 col-md-11 offset-md-0">
            <textarea id="reply" name="reply" class="form-control">{{ old('reply', $reservation->reply) }}</textarea>
            @error('reply')
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <input type="hidden" value="{{ $reservation->comment }}" name="comment">

        <div class="row justify-content-center">
          <button type="submit" name="update" class="col-8 col-md-3 mb-2 mb-md-0 btn btn-primary">更新する</button>
          <a href="{{ route('events.reservations.index', ['event'=>$event->id]) }}" class="col-8 col-md-3 offset-md-1 btn btn-dark">一覧へ戻る</a>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection
