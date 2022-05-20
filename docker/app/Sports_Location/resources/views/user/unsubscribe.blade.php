@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <h3 class="mb-3 text-center">退会確認画面</h3>
  </div>

  <div class="row mb-3">
    <p class="text-md-center text-lg-nowrap">
      退会手続きをされますと、全てのサービスがご利用できなくなります。<br>
      再度ご利用いただくには、新規登録が必要となります。
    </p>
    <p class="text-center">本当に退会してよろしいですか？</p>
  </div>

  <form id="withdraw" method="post" action="{{ route('user.withdraw') }}" name="withdraw">
    @csrf
    <div class="row justify-content-center">
      <button type="submit" name="withdraw" class="col-8 col-md-2 btn btn-danger">{{ __('Unsubscribe') }}</button>
      <a href="{{ route('user.myPage') }}" class="col-8 col-md-2 offset-md-1 mt-2 mt-md-0 btn btn-primary">キャンセル</a>
    </div>
  </form>

</div>
@endsection
