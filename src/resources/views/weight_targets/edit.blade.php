@extends('layouts.app')

@section('content')
<div class="container">
    <h1>目標体重設定</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('weight_targets.update') }}">
        @csrf

        <div class="form-group">
            <label for="target_weight">目標体重（kg）</label>
            <input type="number" step="0.1" class="form-control" id="target_weight" name="target_weight"
                value="{{ old('target_weight', optional($weightTarget)->target_weight) }}" required>
            @error('target_weight')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">更新</button>
        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary mt-3">戻る</a>
    </form>
</div>
@endsection
