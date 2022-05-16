@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3 me-3 text-center">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="profile-image">
      @endif
      <h4 class="mt-3">{{ $user->username }}</h4>
      <a href="{{ route('admin.user.edit', ['username'=>$user->username]) }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-pen"></i></a>
    </div>
    
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-3 border-end">
          <h5 class="text-center">フォロー</h5>
          <p class="fs-4 text-center"><a href="{{ route('admin.user.followings', ['username'=>$user->username]) }}">{{ count($followings) }}</a></p>
        </div>
        <div class="col-md-3">
          <h5 class="text-center">フォロワー</h5>
          <p class="fs-4 text-center"><a href="{{ route('admin.user.followers', ['username'=>$user->username]) }}">{{ count($followers) }}</a></p>
        </div>
      </div>
      <div class="row mt-5">
        <label class="col-md-3 offset-md-1">氏名：</label>
        <p class="col-md-8">{{ $user->name }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-md-3 offset-md-1">フリガナ：</label>
        <p class="col-md-8">{{ $user->kana }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-md-3 offset-md-1">性別：</label>
        <p class="col-md-8">{{ $user->gender_text }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-md-3 offset-md-1">生年月日：</label>
        <p class="col-md-8">{{ $user->formatted_birthday }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-md-3 offset-md-1">電話番号：</label>
        <p class="col-md-8">{{ $user->tel }}</p>
      </div>
      <div class="row mt-2">
        <label class="col-md-3 offset-md-1">メールアドレス：</label>
        <p class="col-md-8">{{ $user->email }}</p>
      </div>
      
      <div class="row mt-3">
        <p class="introduction ps-md-5">{!! nl2br(e($user->introduction)) !!}</p>
      </div>
      <div class="row mt-5 justify-content-center">
        <a href="{{ route('admin.user.createdEvents', ['username'=>$user->username]) }}" class="btn btn-info col-10 col-md-5 me-md-3 mt-2">作成イベント一覧</a>
        <a href="{{ route('admin.user.pastEvents', ['username'=>$user->username]) }}" class="btn btn-info col-10 col-md-5 me-md-3 mt-2">参加済みイベント一覧</a>
      </div>
    </div>

  </div>
</div>

@endsection
