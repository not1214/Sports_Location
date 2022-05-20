@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="text-center mb-3">お問い合わせフォーム</h3>
  <form method="post" action="{{ route('contact.confirm') }}">
    @csrf
    <div class="row mb-3">
      <label for="name" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Name') }}</label>
      <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
      </div>
      @error('name')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">返信用メールアドレス</label>
      <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
      </div>
      @error('email')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="subject" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Subject') }}</label>
      <div class="col-md-6">
          <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}">
      </div>
      @error('subject')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row mb-3">
      <label for="body" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Body') }}</label>
      <div class="col-md-6">
          <textarea id="body" class="form-control" name="body">{{ old('body') }}</textarea>
      </div>
      @error('body')
        <p class="col-md-6 offset-md-4 text-danger">{{ $message }}</p>
      @enderror
    </div>

    <div class="row justify-content-center mb-2">
      <button type="submit" name="confirm" class="col-8 col-md-2 btn btn-primary">
        {{ __('Confirm') }}
      </button>
    </div>
  </form>
</div>
@endsection