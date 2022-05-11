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
      
      <div class="row mb-3">
        <label>コメント：</label>
        <p>{!! nl2br(e($reservation->comment)) !!}</p>
      </div>
      
      <div class="row mb-3">
        <div class="col-md-8">
          <label>ステータス：</label>
          @if($reservation->permission == "1")
          <p>未承認　※開催者の回答をお待ちください。</p>
          @else
          <p>{!! nl2br(e($reservation->permission_text)) !!}</p>
          @endif
        </div>
      </div>
      
      <div class="row mb-3">
        <div>
          <label>返信コメント：</label>
          <p>{!! nl2br(e($reservation->reply)) !!}</p>
        </div>
      </div>

      <div class="row text-center mb-3">
        <form action="{{ route('events.reservations.destroy', ['event'=>$event->id, 'reservation'=>$reservation->id]) }}" method="post">
          @method('delete')
          @csrf
          <button class="col-md-2 btn btn-danger" onclick='return confirm("応募を取り消しますか？");'>取り消し</button>
        </form>
      </div>
    
    </div>

  </div>
</div>
@endsection
