@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-background">
  <div class="auth-card">
    <div class="pigly-logo">PiGLy</div>
    <h2>ログイン</h2>

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
      @error('email') <div class="form__error">{{ $message }}</div> @enderror

      <input type="password" name="password" placeholder="パスワード">
      @error('password') <div class="form__error">{{ $message }}</div> @enderror

      <button type="submit">ログイン</button>
    </form>

    <div class="login-link">
      <a href="{{ route('register') }}">アカウント作成はこちら</a>
    </div>
  </div>
</div>
@endsection
