@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="text-center mb-3">お問い合わせ確認</h3>
  <form method="post" action="{{ route('contact.send') }}">
    @csrf
    <div class="row pt-3 mb-3 border-top">
      <label for="name" class="col-md-4 text-md-end">{{ __('Name') }}</label>
      <div class="col-md-6">
          <div>{{ $data['name'] }}</div>
          <input id="name" type="hidden" name="name" value="{{ $data['name'] }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="email" class="col-md-4 text-md-end">返信用メールアドレス</label>
      <div class="col-md-6">
        <div>{{ $data['email'] }}</div>
        <input id="email" type="hidden" name="email" value="{{ $data['email'] }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="subject" class="col-md-4 text-md-end">{{ __('Subject') }}</label>
      <div class="col-md-6">
        <div>{{ $data['subject'] }}</div>
        <input id="subject" type="hidden" name="subject" value="{{ $data['subject'] }}">
      </div>
    </div>

    <div class="row pb-3 mb-3 border-bottom">
      <label for="body" class="col-md-4 text-md-end">{{ __('Body') }}</label>
      <div class="col-md-6">
        <div id="body" name="body">{!! nl2br(e($data['body'])) !!}</div>
        <input id="subject" type="hidden" name="subject" value="{{ $data['body'] }}">
      </div>
    </div>

    <div class="row mb-2 justify-content-center">
      <div class="col-12 text-center">
        <button type="submit" name="send" class="col-md-1 btn btn-primary">
          {{ __('Send') }}
        </button>
        <button type="submit" name="back" class="btn btn-danger col-md-1 offset-md-1">
          {{ __('Back') }}
        </button>
      </div>
    </div>
  </form>
</div>
@endsection