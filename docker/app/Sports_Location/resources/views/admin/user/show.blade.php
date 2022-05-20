@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3 me-md-3">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @endif
      <h4 class="mt-3 text-center">{{ $user->username }}</h4>
      <a href="{{ route('admin.user.edit', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
    </div>

    <div class="col-md-8">
      <div class="row mt-3 mt-md-0">

        <div class="col-5 offset-1 col-md-3 offset-md-1 border-end">
          <h5 class="text-center fw-bold">フォロー</h5>
          <p class="fs-4 text-center"><a href="{{ route('admin.user.followings', ['username'=>$user->username]) }}">{{ count($followings) }}</a></p>
        </div>

        <div class="col-5 col-md-3">
          <h5 class="text-center fw-bold">フォロワー</h5>
          <p class="fs-4 text-center"><a href="{{ route('admin.user.followers', ['username'=>$user->username]) }}">{{ count($followers) }}</a></p>
        </div>
      </div>

      <div class="row mt-3">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">氏名：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->name }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">フリガナ：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->kana }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">性別：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->gender_text }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">生年月日：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->formatted_birthday }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">電話番号：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->tel }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-10 offset-1 col-md-4 col-lg-3 offset-md-0 text-md-end fw-bold">メールアドレス：</label>
        <p class="col-10 col-md-8 offset-1 offset-md-0">{{ $user->email }}</p>
      </div>

      <div class="row mt-3">
        <p class="col-10 offset-1">{!! nl2br(e($user->introduction)) !!}</p>
      </div>
      <div class="row mt-5 justify-content-center">
        <a href="{{ route('admin.user.createdEvents', ['username'=>$user->username]) }}" class="btn btn-info col-8 col-md-5 me-md-3">作成イベント一覧</a>
        <a href="{{ route('admin.user.pastEvents', ['username'=>$user->username]) }}" class="btn btn-info col-8 col-md-5 me-md-3 mt-2 mt-md-0">参加済みイベント一覧</a>
      </div>
    </div>

  </div>
</div>

@endsection
