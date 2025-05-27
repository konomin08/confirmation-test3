<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $userId = $user->id;

        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        return view('weight_targets.edit', compact('weightTarget'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $userId = $user->id;

        $request->validate([
            'target_weight' => 'required|numeric|min:20|max:300',
        ]);

        $weightTarget = WeightTarget::firstOrNew(['user_id' => $userId]);
        $weightTarget->target_weight = $request->input('target_weight');
        $weightTarget->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました');
    }
}
