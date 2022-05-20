<div class="container">
  <div class="row">

    <div class="col-md-3 me-3">
      @if(isset($user->profile_image))
      <img src="{{ asset($user->profile_image) }}" class="col-10 offset-1 col-md-12 offset-md-0 profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="col-10 offset-1 col-md-12 offset-md-0 profile-image">
      @endif
      <h4 class="mt-3 text-center">{{ $user->username }}</h4>
      @if($target == 'mine')
      <a href="{{ route('user.edit') }}" class="col-8 offset-2 col-md-10 offset-md-1 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-pen"></i></a>
      @elseif($target == 'other')
        @if($follow)
        <a href="{{ route('user.unFollow', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 btn btn-primary mt-3 text-center"><i class="fa-solid fa-user-check"></i></a>
        @else
        <a href="{{ route('user.follow', ['username'=>$user->username]) }}" class="col-8 offset-2 col-md-10 offset-md-1 btn btn-outline-secondary mt-3 text-center"><i class="fa-solid fa-user-plus"></i></a>
        @endif
      @endif
    </div>

    <div class="col-md-8">
      <div class="row mt-3 mt-md-0">
        <div class="col-5 offset-1 col-md-3 offset-md-1 border-end">
          <h5 class="text-center fw-bold">フォロー</h5>
          @if($target == 'mine')
          <p class="fs-4 text-center"><a href="{{ route('user.my_followings') }}">{{ count($followings) }}</a></p>
          @else
          <p class="fs-4 text-center"><a href="{{ route('user.followings', ['username'=>$user->username]) }}">{{ count($followings) }}</a></p>
          @endif
        </div>

        <div class="col-5 col-md-3">
          <h5 class="text-center fw-bold">フォロワー</h5>
          @if($target == 'mine')
          <p class="fs-4 text-center"><a href="{{ route('user.my_followers') }}">{{ count($followers) }}</a></p>
          @else
          <p class="fs-4 text-center"><a href="{{ route('user.followers', ['username'=>$user->username]) }}">{{ count($followers) }}</a></p>
          @endif
        </div>
      </div>

      <div class="row mt-3">
        <p class="col-10 offset-1">{!! nl2br(e($user->introduction)) !!}</p>
      </div>

      <div class="row mt-3 justify-content-center">
        @if($target == 'mine')
        <a href="{{ route('user.createdEvents') }}" class="btn btn-info col-8 col-md-5 me-md-3">作成イベント一覧</a>
        <a href="{{ route('user.favoriteEvents') }}" class="btn btn-info col-8 col-md-5 me-md-3 mt-2 mt-md-0">お気に入りイベント一覧</a>
        <a href="{{ route('user.pastEvents') }}" class="btn btn-info col-8 col-md-5 me-md-3 mt-2">参加済みイベント一覧</a>
        <a href="{{ route('user.reservedEvents') }}" class="btn btn-info col-8 col-md-5 me-md-3 mt-2">予約済みイベント一覧</a>
        @else
        <a href="{{ route('user.events', ['username'=>$user->username]) }}" class="btn btn-info col-10 col-md-5 me-md-3">作成イベント一覧</a>
        @endif
      </div>
    </div>

  </div>
</div>
