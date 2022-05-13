<h3>{{ $name }}さんより</h3>
<p>
  返信先メールアドレス：<br>
  {{ $email }}
</p>
<p>
  件名：<br>
  {{ $subject }}
</p>
<p>
  内容：<br>
  {!! nl2br(e($body)) !!}
</p>