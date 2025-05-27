@extends('layouts.app')

@section('content')
<div class="container">
    <h1>体重ログ編集</h1>

    <form method="POST" action="{{ route('weight_logs.update', $weightLog->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>日付</label>
            <input type="date" name="recorded_at" value="{{ old('recorded_at', $weightLog->recorded_at->format('Y-m-d')) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>体重 (kg)</label>
            <input type="number" step="0.1" name="weight" value="{{ old('weight', $weightLog->weight) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>摂取カロリー</label>
            <input type="number" name="calories" value="{{ old('calories', $weightLog->calories) }}" class="form-control">
        </div>

        <div class="form-group">
            <label>運動時間</label>
            <input type="time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}" class="form-control">
        </div>

        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_content" class="form-control">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
