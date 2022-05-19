@extends('layouts.app')

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
      @if(Auth::id() == $user->id )
      <a href="{{ route('user.edit') }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-pen"></i></a>
      @else
        @if($follow)
        <a href="{{ route('user.unFollow', ['username'=>$user->username]) }}" class="col-10 btn btn-primary mt-5"><i class="fa-solid fa-user-check"></i></a>
        @else
        <a href="{{ route('user.follow', ['username'=>$user->username]) }}" class="col-10 btn btn-outline-secondary mt-5"><i class="fa-solid fa-user-plus"></i></a>
        @endif
      @endif
    </div>
    
    <div class="col-md-8">
      <div class="row mb-3">
        <h3>フォローワー</h3>
      </div>
      @foreach ($followers as $follower)
        <div class="row mb-3 border-bottom">
        @if($follower)
          @if(isset($follower->profile_image))
            <img class="col-md-1 me-2" src="{{ asset($follower->profile_image) }}" style="border-radius:50%;">
          @else
            <img class="col-md-1 me-2" src="{{ asset('images/no-image.png') }}">
          @endif
          <div class="col-md-8">
            <div class="col-12">
              <a href="{{ route('user.show', ['username'=>$follower->username]) }}" class="fs-4 fw-bold">{{ $follower->username }}</a>
            </div>
          </div>
        @endif
        </div>
      @endforeach
    </div>

  </div>
</div>

@endsection