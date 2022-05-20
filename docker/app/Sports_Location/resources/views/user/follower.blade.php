@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-3 me-md-5">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="col-8 offset-2 col-md-12 offset-md-0 profile-image">
      @endif
      <h4 class="mt-3 text-center">{{ $user->username }}</h4>
      @if(Auth::id() == $user->id )
      <a href="{{ route('user.edit') }}" class="col-8 offset-2 col-md-10 offset-md-1 mb-5 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
      @else
        @if($follow)
        <a href="{{ route('user.unFollow', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 btn btn-primary mt-3 text-center"><i class="fa-solid fa-user-check"></i></a>
        @else
        <a href="{{ route('user.follow', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 mb-5 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-plus"></i></a>
        @endif
      @endif
    </div>

    <div class="col-10 offset-1 col-md-8 offset-md-0">
      <div class="row mb-3">
        <h3>フォローワー</h3>
      </div>

      @foreach ($followers as $follower)
      <div class="row mb-3 border-bottom">
        @if(isset($follower->profile_image))
        <img class="col-3 col-md-3 col-lg-2 me-2" src="{{ asset($follower->profile_image) }}" style="border-radius:50%;max-height:60px;">
        @else
        <img class="col-3 col-md-3 col-lg-2 me-2" src="{{ asset('images/no-image.png') }}" style="border-radius:50%;max-height:60px;">
        @endif

        <div class="col-8 col-md-8">
          <a href="{{ route('user.show', ['username'=>$follower->username]) }}" class="fs-4 fw-bold">{{ $follower->username }}</a>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</div>

@endsection
