@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-background">
  <div class="auth-card">
    <div class="pigly-logo">PiGLy</div>
    <h2>新規会員登録</h2>
    <p class="step-info">STEP1 アカウント情報の登録</p>
    <form action="/register/step1" method="POST">
      @csrf
      <input type="text" name="name" placeholder="お名前" value="{{ old('name') }}">
      @error('name') <div class="form__error">{{ $message }}</div> @enderror

      <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
      @error('email') <div class="form__error">{{ $message }}</div> @enderror

      <input type="password" name="password" placeholder="パスワード">
      @error('password') <div class="form__error">{{ $message }}</div> @enderror

      <button type="submit">次に進む</button>
    </form>

    <div class="login-link">
      <a href="{{ route('login') }}">ログインはこちら</a>
    </div>
  </div>
</div>
