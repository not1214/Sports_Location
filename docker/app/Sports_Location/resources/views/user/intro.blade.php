<div class="container">
  <div class="row">
    <div class="col-md-3 me-3 text-center">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="profile-image">
      @endif
      <h4 class="mt-3">{{ $user->username }}</h4>
      @if($target == 'mine')
      <a href="{{ route('user.edit') }}" class="col-10 btn btn-secondary mt-5 fa-solid fa-user-pen"></a>
      @endif
    </div>
    
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-3 border-end">
          <h5 class="text-center">フォロー</h5>
          <p class="text-center">--</p>
        </div>
        <div class="col-md-3">
          <h5 class="text-center">フォロワー</h5>
          <p class="text-center">--</p>
        </div>
      </div>
      <div class="row mt-5">
        <p class="introduction ps-md-5">{{ $user->introduction }}</p>
      </div>
      <div class="row mt-5 justify-content-center">
        <a href="{{ route('user.createdEvents') }}" class="btn btn-info col-10 col-md-5 me-md-3">作成イベント一覧</a>
        <a href="{{ route('user.favoriteEvents') }}" class="btn btn-info col-10 col-md-5 me-md-3 mt-2 mt-md-0">お気に入りイベント一覧</a>
        <a href="{{ route('user.pastEvents') }}" class="btn btn-info col-10 col-md-5 me-md-3 mt-2">参加済みイベント一覧</a>
        <a href="{{ route('user.reservedEvents') }}" class="btn btn-info col-10 col-md-5 me-md-3 mt-2">予約済みイベント一覧</a>
      </div>
    </div>

  </div>
</div>