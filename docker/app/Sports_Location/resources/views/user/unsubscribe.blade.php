@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h3 class="mb-3 text-center">退会確認画面</h3>
    <p class="col-md-7 offset-md-3">
      退会手続きをされますと、全てのサービスがご利用できなくなります。<br>
      再度ご利用いただくには、新規登録が必要となります。
    </p>
    <p class="col-md-7 offset-md-3">本当に退会してよろしいですか？</p>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-2">
      <form id="withdraw" method="post" action="{{ route('user.withdraw') }}" name="withdraw">
        @csrf
        <button type="submit" name="withdraw" class="col-12 btn btn-danger">{{ __('Unsubscribe') }}</button>
      </form>
    </div>
    <div class="col-md-2">
      <a href="{{ route('user.myPage') }}" class="col-12 btn btn-primary">キャンセル</a>
    </div>
  </div>
</div>
@endsection