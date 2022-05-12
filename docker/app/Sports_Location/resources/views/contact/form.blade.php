@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="text-center mb-3">お問い合わせフォーム</h3>
  <form method="post" action="{{ route('contact.confirm') }}">
    @csrf
    <div class="row mb-3">
      <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
      <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="email" class="col-md-4 col-form-label text-md-end">返信用メールアドレス</label>
      <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
      </div>
    </div>

    <div class="row mb-3">
      <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>
      <div class="col-md-6">
          <input id="subject" type="text" class="form-control" name="subject" required value="{{ old('subject') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="body" class="col-md-4 col-form-label text-md-end">{{ __('Body') }}</label>
      <div class="col-md-6">
          <textarea id="body" class="form-control" name="body" required>{{ old('body') }}</textarea>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-12 text-center">
        <button type="submit" name="confirm" class="col-md-1 btn btn-primary">
            {{ __('Confirm') }}
        </button>
      </div>
    </div>
  </form>
</div>
@endsection