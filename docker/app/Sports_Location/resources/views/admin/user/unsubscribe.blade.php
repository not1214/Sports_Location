@extends('layouts/app_admin')

@section('content')
<div class="container">

  <div class="row">
    <h3 class="mb-3 text-center">退会確認画面</h3>
  </div>

  <div class="row mb-3">
    <p class="text-center text-lg-nowrap">
      このユーザーを退会させることができます。
    </p>
    <p class="text-center">本当に退会させてよろしいですか？</p>
  </div>

  <form id="withdraw" method="post" action="{{ route('admin.user.withdraw', ['username'=>$username]) }}" name="withdraw">
    @csrf

    <div class="row justify-content-center">
      <button type="submit" name="withdraw" class="col-8 col-md-2 btn btn-danger">退会させる</button>
      <a href="{{ route('admin.user.show', ['username'=>$username]) }}" class="col-8 col-md-2 offset-md-1 mt-2 mt-md-0 btn btn-primary">キャンセル</a>
    </div>
  </form>

</div>
@endsection
