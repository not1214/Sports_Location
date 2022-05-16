@extends('layouts/app_admin')

@section('content')
<div class="container">
  <div class="row mb-5 text-center">
    <h3>ジャンル編集</h3>
  </div>

  <form action="{{ route('admin.genres.update', ['genre'=>$genre->id]) }}" method="post">
  @method('patch')
  @csrf
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <label for="genre" class="col-md-4 offset-md-1 col-form-label text-md-end">ジャンル名</label>
          <div class="col-md-7">
            <input id="genre" name="name" type="text" class="form-control" value="{{ old('genre', $genre->genre_name) }}">
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mt-2 mt-md-0 text-end text-md-start">
        <button type="submit" class="btn btn-success">編集</button>
      </div>
    </div>
  </form>
</div>
@endsection
