@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row">
    <h3 class="mb-3 text-center">退会確認画面</h3>
    <p class="col-md-7 offset-md-3">
      このユーザーを退会させることができます。
    </p>
    <p class="col-md-7 offset-md-3">本当に退会させてよろしいですか？</p>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-2">
      <form id="withdraw" method="post" action="{{ route('admin.user.withdraw', ['username'=>$username]) }}" name="withdraw">
        @csrf
        <button type="submit" name="withdraw" class="col-12 btn btn-danger">退会させる</button>
      </form>
    </div>
    <div class="col-md-2">
      <a href="{{ route('admin.user.show', ['username'=>$username]) }}" class="col-12 btn btn-primary">キャンセル</a>
    </div>
  </div>
</div>
@endsection
