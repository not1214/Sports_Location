<div class="container">
  <div class="row">
    <div class="col-md-3 me-3 text-center">
      @if(isset($user->profile_image))
      <img src="{{ asset('$user->profile_image') }}" class="profile-image">
      @else
      <img src="{{ asset('images/no-image(user).jpg') }}" class="profile-image">
      @endif
      @if($target == 'mine')
      <button href="{{ route('user.edit') }}" class="btn btn-secondary mt-5"></button>
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
        <p class="introduction ps-md-5">----------------</p>
      </div>
    </div>

  </div>
</div>