@extends('layouts.app')

@section('content')

<div class="container">
    
    @if($event->status == '0')
        <div class="row mb-3 text-center text-danger">
            募集は終了しました。
        </div>
    @endif

    <div class="row my-5">
        <div class="col-md-4 offset-md-1 text-center">
            @if(!empty($event->event_image))
            <img src="{{ asset($event->event_image) }}" class="event_image">
            @else
            <img src="{{ asset('images/no-image.png') }}" class="event_image">
            @endif
        </div>
        <div class="col-md-6 my-auto">
            <div class="mb-3">開催者：{{ $event->user->username }}</div>
            <h3 class="mb-3">{{ $event->title }}</h3>
            @if(Auth::id() == $event->user_id)
                <a href="#" class="btn btn-success col-md-3">予約申請一覧</a>
                <a href="/events/{{ $event->id }}/edit" class="btn btn-primary col-md-3 ms-2">編集する</a>
                <a href="#" class="btn btn-danger col-md-3 ms-2">削除する</a>
            @else
                <a href="#" class="btn btn-primary" @if($event->status == '0') disabled @endif>応募する</a>
            @endif
        </div>
    </div>

    <div class="row py-3 mb-3 border-top border-dark">
        <label for="area" class="col-md-4 text-md-end">{{ __('Area') }}</label>

        <div class="col-md-6 offset-md-1">
            {{ $event->area->name }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="location" class="col-md-4 text-md-end">{{ __('Location') }}</label>

        <div class="col-md-6 offset-md-1">
            <p>{{ $event->location }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="date" class="col-md-4 text-md-end">{{ __('Date') }}</label>

        <div class="col-md-4 offset-md-1">
            <p>{{ $event->date }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="start_time" class="col-md-4 text-md-end">{{ __('Start_time') }}</label>

        <div class="col-md-4 offset-md-1">
            <p>{{ $event->start_time }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="end_time" class="col-md-4 text-md-end">{{ __('End_time') }}</label>

        <div class="col-md-4 offset-md-1">
            <p>{{ $event->end_time }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="contents" class="col-md-4 text-md-end">{{ __('Contents') }}</label>

        <div class="col-md-6 offset-md-1">
            <p>{{ $event->contents }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="condition" class="col-md-4 text-md-end">{{ __('Condition') }}</label>

        <div class="col-md-6 offset-md-1">
            <p>{{ $event->condition }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="stuff" class="col-md-4 text-md-end">{{ __('Stuff') }}</label>

        <div class="col-md-6 offset-md-1">
            <p>{{ $event->stuff }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="attention" class="col-md-4 text-md-end">{{ __('Attention') }}</label>

        <div class="col-md-6 offset-md-1">
            <p>{{ $event->attention }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <label for="number" class="col-md-4 text-md-end">{{ __('Number') }}</label>

        <div class="col-md-4 offset-md-1">
            <p>{{ $event->number }}名</p>
        </div>
    </div>

    <div class="row mb-4 border-bottom border-dark">
        <label for="deadline" class="col-md-4 text-md-end">{{ __('Deadline') }}</label>

        <div class="col-md-4 offset-md-1">
            <p>{{ $event->deadline }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 mx-auto text-center">
            <a href="/events" class="btn btn-dark">イベント一覧へ戻る</a>
        </div>
    </div>
</div>
@endsection