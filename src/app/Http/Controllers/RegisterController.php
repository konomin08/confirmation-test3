<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\InitialWeightRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 会員登録画面（step1）を表示
    public function showStep1()
    {
        return view('auth.register_step1');
    }

    // step1 で会員登録処理
    public function register(RegisterRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // 新規ユーザー登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // 登録後にログイン

        return redirect()->route('register.step2'); // 初期体重登録画面へ
    }

    // 初期体重登録画面（step2）を表示
    public function showStep2()
    {
        return view('auth.register_step2');
    }
    public function postStep2(InitialWeightRequest $request)
    {

    $user = auth()->user();

    // 体重ログ登録（現在の体重）
    WeightLog::create([
        'user_id' => $user->id,
        'weight' => $request->current_weight,
        'date' => now()->toDateString(),
        'recorded_at' => now(),
        'calories' => 0,
        'exercise_time' => 0,
        'exercise_content' => '',
    ]);

    // 目標体重登録（weight_targetテーブルへ）
    WeightTarget::updateOrCreate(
        ['user_id' => $user->id],
        ['target_weight' => $request->target_weight]
    );

    return redirect()->route('weight_logs.index');
    }
}
