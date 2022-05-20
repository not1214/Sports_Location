@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row mb-5">
    <h3 class="text-center">プロフィール編集</h3>
  </div>

  <form method="post" action="{{ route('admin.user.update', ['username'=>$user->username]) }}" enctype="multipart/form-data" name="form">
    @method('put')
    @csrf

    <input type="hidden" value="{{ $user->id }}" name="user_id">

    <div class="row mb-3">
      <label for="profile_image" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Profile_image') }}</label>

      <div class="col-md-6">
          <input id="profile_image" type="file" class="form-control" name="profile_image">
      </div>
      @error('profile_image')
          <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="username" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Username') }}</label>

      <div class="col-md-6">
          <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
      </div>
      @error('username')
          <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="introduction" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Introduction') }}</label>

      <div class="col-md-6">
        <textarea id="introduction" class="form-control" name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
      </div>
      @error('introduction')
          <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3 justify-content-center">
      <button type="submit" name="update" class="col-8 col-md-2 mb-2 mb-md-0 btn btn-success">
        {{ __('Update') }}
      </button>
      <a href="{{ route('admin.user.unsubscribe', ['username'=>$user->username]) }}" name="unsubscribe" class="col-8 col-md-2 offset-md-1 btn btn-danger">退会させる</a>
    </div>

  </form>

</div>
@endsection
