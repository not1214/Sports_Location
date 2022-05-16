@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row justify-content-center mb-3">
    <h3>ユーザー一覧</h3>
  </div>

  <div class="row">
    <div class="col">
      <table class="table table-border table-striped">
        <tr>
          <th>会員ID</th>
          <th>ユーザー名</th>
          <th>氏名</th>
          <th>ステータス</th>
        </tr>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td><a href="{{ route('admin.user.show', ['username'=>$user->username]) }}">{{ $user->username }}</a></td>
          <td>{{ $user->name }}</td>
          @if(!empty($user->deleted_at))
          <td>退会済み</td>
          @else
          <td>会員</td>
          @endif
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
