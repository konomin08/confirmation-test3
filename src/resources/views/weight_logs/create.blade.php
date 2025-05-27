@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('content')
<div class="modal-overlay">
  <div class="modal">
    <h2>weight_Logを追加</h2>
    <form action="{{ route('weight_logs.store') }}" method="POST">
      @csrf

      <label>日付</label>
      <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}">
      @error('date')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label>体重 (kg)</label>
      <input type="number" step="0.1" name="weight" value="{{ old('weight') }}">
      @error('weight')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label>摂取カロリー</label>
      <input type="number" name="calories" value="{{ old('calories') }}">
      @error('calories')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label>運動時間 (分)</label>
      <input type="number" name="exercise_time" value="{{ old('exercise_time') }}">
      @error('exercise_time')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <label>運動内容</label>
      <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
      @error('exercise_content')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <button type="submit">登録</button>
      <a href="{{ route('weight_logs.index') }}" class="btn">戻る</a>
    </form>
  </div>
</div>
@endsection
