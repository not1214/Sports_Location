@extends('layouts/app_admin')

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
      <a href="{{ route('admin.user.edit', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 mb-5 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
    </div>

    <div class="col-10 offset-1 col-md-8 offset-md-0">
      <div class="row mb-3">
        <h3>フォロー</h3>
      </div>

      @foreach ($followings as $following)
      <div class="row mb-3 border-bottom">
        @if(isset($following->profile_image))
          <img class="col-3 col-md-3 col-lg-2 me-2" src="{{ asset($following->profile_image) }}" style="border-radius:50%;max-height:60px;">
        @else
          <img class="col-3 col-md-3 col-lg-2 me-2" src="{{ asset('images/no-image.png') }}" style="border-radius:50%;max-height:60px;">
        @endif
        <div class="col-8 col-md-8">
          <a href="{{ route('admin.user.show', ['username'=>$following->username]) }}" class="fs-4 fw-bold">{{ $following->username }}</a>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</div>
@endsection
