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
        <h3>応募申請詳細</h3>
      </div>

      <div class="row mb-3">
        @if(isset($reservation->user->profile_image))
        <img class="col-2 offset-1 col-md-2 offset-md-0 col-lg-1 me-2" src="{{ asset($reservation->user->profile_image) }}" style="border-radius:50%;">
        @else
        <img class="col-2 col-md-2 col-lg-1 me-2" src="{{ asset('images/no-image.png') }}">
        @endif
        <div class="col-7 col-md-8">
          <a href="{{ route('user.show', ['username'=>$reservation->user->username]) }}" class="fs-4 fw-bold">{{ $reservation->user->username }}</a>
        </div>
      </div>
      
      <div class="row mb-3">
        <label class="col-10 offset-1 col-md-11 offset-md-0 fw-bold">コメント：</label>
        <p class="col-10 offset-1 col-md-11 offset-md-0 text-break">{!! nl2br(e($reservation->comment)) !!}</p>
      </div>
      
      <div class="row mb-3">
        <div class="col-10 offset-1 col-md-5 offset-md-0">
          <label class="fw-bold">ステータス：</label>
          @if($reservation->permission == "1")
          <p>未承認　※開催者の回答をお待ちください。</p>
          @else
          <p>{!! nl2br(e($reservation->permission_text)) !!}</p>
          @endif
        </div>
      </div>
      
      <div class="row mb-5">
        <label class="col-10 offset-1 col-md-11 offset-md-0 fw-bold">返信コメント：</label>
        <p class="col-10 offset-1 col-md-11 offset-md-0">{!! nl2br(e($reservation->reply)) !!}</p>
      </div>

      <div class="row text-center">
        <form action="{{ route('events.reservations.destroy', ['event'=>$event->id, 'reservation'=>$reservation->id]) }}" method="post">
          @method('delete')
          @csrf
          <button class="col-8 col-md-3 btn btn-danger @if($event->deadline < \Carbon\Carbon::now()) disabled @endif" onclick='return confirm("応募を取り消しますか？");'>取り消し</button>
        </form>
      </div>
    
    </div>

  </div>
</div>
@endsection
