<h3>{{ $name }}さんより</h3>
<p>返信先メールアドレス：{{ $email }}</p>
<p>件名：{{ $subject }}</p>
<p>
  内容：
  {!! nl2br(e($body)) !!}
</p>