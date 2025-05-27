<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightLogRequest;

class WeightLogController extends Controller
{
    public function index()
    {
        $userId = 1;

        $targetWeightObj = \App\Models\WeightTarget::where('user_id', $userId)->first();
        $targetWeight = $targetWeightObj ? $targetWeightObj->target_weight : 0;

        $latestWeightLog = \App\Models\WeightLog::where('user_id', $userId)
            ->orderBy('recorded_at', 'desc')
            ->first();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : 0;

        $weightLogs = \App\Models\WeightLog::where('user_id', $userId)
            ->orderBy('recorded_at', 'desc')
            ->paginate(8);

        return view('weight_logs.index', compact('weightLogs', 'targetWeight', 'latestWeight'));
    }

    public function search(Request $request)
    {
        $userId = 1;

        $query = WeightLog::where('user_id', $userId);

        if ($request->filled('from')) {
            $query->whereDate('recorded_at', '>=', $request->input('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('recorded_at', '<=', $request->input('to'));
        }

        $weightLogs = $query->orderBy('recorded_at', 'desc')->paginate(8);

        $targetWeightObj = \App\Models\WeightTarget::where('user_id', $userId)->first();
        $targetWeight = $targetWeightObj ? $targetWeightObj->target_weight : 0;

        $latestWeightLog = WeightLog::where('user_id', $userId)->orderBy('recorded_at', 'desc')->first();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : 0;

        return view('weight_logs.index', compact('weightLogs', 'targetWeight', 'latestWeight'));
    }

    public function edit($id)
    {
        $userId = 1;

        $weightLog = WeightLog::where('user_id', $userId)->findOrFail($id);

        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(Request $request, $id)
    {
        $userId = 1;

        $weightLog = WeightLog::where('user_id', $userId)->findOrFail($id);

        $request->validate([
            'recorded_at' => 'required|date',
            'weight' => 'required|numeric',
            'calories' => 'nullable|integer',
            'exercise_time' => 'nullable',
            'exercise_content' => 'nullable|string',
        ]);

        $weightLog->update($request->only(['recorded_at', 'weight', 'calories', 'exercise_time', 'exercise_content']));

        return redirect()->route('weight_logs.index')->with('success', '体重ログを更新しました。');
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    // ↓↓↓ この部分が問題の箇所だと思われる ↓↓↓
    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'recorded_at' => $request->recorded_at,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }
}
