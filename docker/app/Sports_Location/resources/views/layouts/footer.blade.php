<div class="container">
  <div class="row">

    <div class="col-6 col-md-3 pt-1 order-1">
      <a style="float:left; font-size:20px;" href="{{ url('/') }}">
        {{ config('app.name') }}
      </a>
    </div>

    <div class="col-12 col-md-6 pt-md-3 text-center order-3 order-md-2">
      © Sports Location.
      All rights reserved.
    </div>

    <div class="col-6 col-md-3 pt-1 order-2 order-md-3">
      <ul style="list-style:none;">
        <li class="text-end"><a href="{{ route('contact.form') }}">お問い合わせ</a></li>
        <li class="text-end"><a href="/rule">利用ルール</a></li>
      </ul>
    </div>

  </div>
</div>
