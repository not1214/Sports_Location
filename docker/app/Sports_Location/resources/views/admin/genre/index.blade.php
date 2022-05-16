@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row mb-5 text-center">
    <h3>ジャンル作成・一覧</h3>
  </div>

  <form action="{{ route('admin.genres.store') }}" method="post">
  @csrf
    <div class="row mb-5">
      <div class="col-md-8">
        <div class="row">
          <label for="genre" class="col-md-4 offset-md-1 col-form-label text-md-end">ジャンル名</label>
          <div class="col-md-7">
            <input id="genre" name="name" type="text" class="form-control">
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mt-2 mt-md-0 text-end text-md-start">
        <button type="submit" class="btn btn-success">追加</button>
      </div>
    </div>
  </form>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-bordered">
        <tr>
          <th width="75%">ジャンル名</th>
          <td width="25%"></td>
        </tr>
        @foreach($genres as $genre)
        <tr>
          <td>{{ $genre->genre_name }}</td>
          <td class="text-center"><a href="{{ route('admin.genres.edit', ['genre'=>$genre->id]) }}" class="btn btn-primary">編集</a></td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
