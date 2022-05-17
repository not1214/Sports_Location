@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mb-5">
    <h3 class="text-center">プロフィール編集</h3>
  </div>
  
  <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data" name="form">
  @method('put')
  @csrf
  
  <div class="row mb-3">
    <label for="profile_image" class="col-md-4 col-form-label text-md-end">{{ __('Profile_image') }}</label>

    <div class="col-md-6">
        <input id="profile_image" type="file" class="form-control" name="profile_image">
    </div>
    @error('profile_image')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
    @enderror
  </div>

  <div class="row mb-3">
    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
    </div>
    @error('username')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
    @enderror
  </div>

  <div class="row mb-3">
    <label for="introduction" class="col-md-4 col-form-label text-md-end">{{ __('Introduction') }}</label>

    <div class="col-md-6">
      <textarea id="introduction" class="form-control" name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
    </div>
    @error('introduction')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
    @enderror
  </div>

  <div class="row mb-3">
    <div class="col-md-12 text-center">
      <button type="submit" name="update" class="col-md-2 btn btn-success">
          {{ __('Update') }}
      </button>
      <a href="{{ route('user.unsubscribe') }}" name="unsubscribe" class="col-md-2 offset-md-1 btn btn-danger">{{ __('Unsubscribe') }}</a>
    </div>
  </div>
  
  </form>

</div>
@endsection