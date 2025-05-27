@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_log.css') }}">

<div class="container">

    <div class="header">
      <div class="header-left">
        <h1>体重管理アプリ</h1>
      </div>
      <div class="header-right">
        <a href="{{ route('weight_target.edit') }}" class="btn-goal-setting">目標体重設定</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
          @csrf
          <button type="submit" class="btn-logout">ログアウト</button>
        </form>
      </div>
    </div>

    {{-- 上部カード --}}
    <div class="card-area">
        <div class="card">
            <p class="card-label">目標体重</p>
            <p class="card-value">{{ number_format($targetWeight, 1) }}kg</p>
        </div>
        <div class="card">
            <p class="card-label">目標まで</p>
            <p class="card-value">{{ number_format($latestWeight - $targetWeight, 1) }}kg</p>
        </div>
        <div class="card">
            <p class="card-label">最新体重</p>
            <p class="card-value">{{ number_format($latestWeight, 1) }}kg</p>
        </div>
    </div>

    <div class="search-area">
        <form method="GET" action="{{ url('/weight_logs/search') }}" class="search-form">
            <input type="date" name="from">
            <span>〜</span>
            <input type="date" name="to">
            <button type="submit" class="btn">検索</button>
        </form>

        <a href="{{ route('weight_target.edit') }}" class="btn-goal-setting">目標体重設定</a>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout">ログアウト</button>
        </form>

      <!-- データを追加ボタン -->
      <a href="{{ route('weight_logs.create') }}" class="btn btn-primary">データを追加</a>

    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th>編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weightLogs as $log)
                <tr>
                    <td>{{ $log->recorded_at->format('Y/m/d') }}</td>
                    <td>{{ $log->weight }}kg</td>
                    <td>{{ $log->calories }}cal</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td><a href="{{ url("/weight_logs/{$log->id}/update") }}" class="edit-link">✎</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $weightLogs->links() }}
    </div>

</div>
@endsection
