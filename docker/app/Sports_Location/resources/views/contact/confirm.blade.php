@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="text-center mb-3">お問い合わせ確認</h3>
  <form method="post" action="{{ route('contact.send') }}">
    @csrf
    <div class="row pt-3 mb-3 border-top">
      <label for="name" class="col-md-4 text-md-end fw-bold">{{ __('Name') }}</label>
      <div class="col-md-6">
          <div>{{ $data['name'] }}</div>
          <input id="name" type="hidden" name="name" value="{{ $data['name'] }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="email" class="col-md-4 text-md-end fw-bold">返信用メールアドレス</label>
      <div class="col-md-6">
        <div>{{ $data['email'] }}</div>
        <input id="email" type="hidden" name="email" value="{{ $data['email'] }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="subject" class="col-md-4 text-md-end fw-bold">{{ __('Subject') }}</label>
      <div class="col-md-6">
        <div>{{ $data['subject'] }}</div>
        <input id="subject" type="hidden" name="subject" value="{{ $data['subject'] }}">
      </div>
    </div>

    <div class="row pb-3 mb-3 border-bottom">
      <label for="body" class="col-md-4 text-md-end fw-bold">{{ __('Body') }}</label>
      <div class="col-md-6">
        <div id="body" name="body" class="text-break">{!! nl2br(e($data['body'])) !!}</div>
        <input id="body" type="hidden" name="body" value="{{ $data['body'] }}">
      </div>
    </div>

    <div class="row mb-2 justify-content-center">
      <button type="submit" name="send" class="col-8 col-md-4 col-lg-2 btn btn-primary">
        {{ __('Send') }}
      </button>
      <button type="submit" name="back" value="true" class="col-8 col-md-4 col-lg-2 offset-md-1 mt-2 mt-md-0 btn btn-danger">
        {{ __('Back') }}
      </button>
    </div>
  </form>

</div>
@endsection
