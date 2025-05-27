@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-background">
  <div class="auth-card">
    <div class="pigly-logo">PiGLy</div>
    <h2>初期体重登録</h2>
    <form action="{{ route('register.step2.store') }}" method="POST">
      @csrf

      <input type="number" step="0.1" name="current_weight" placeholder="現在の体重 (kg)" value="{{ old('current_weight') }}">
      @error('current_weight') <div class="form__error">{{ $message }}</div> @enderror

      <input type="number" step="0.1" name="target_weight" placeholder="目標の体重 (kg)" value="{{ old('target_weight') }}">
      @error('target_weight') <div class="form__error">{{ $message }}</div> @enderror

      <button type="submit">アカウント作成</button>
    </form>
  </div>
</div>
@endsection
