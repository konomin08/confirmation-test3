<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('register.step1');
});

Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/weight_targets/edit', [WeightTargetController::class, 'edit'])->name('weight_targets.edit');
    Route::post('/weight_targets/update', [WeightTargetController::class, 'update'])->name('weight_targets.update');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');

    Route::post('/register/step2', [RegisterController::class, 'postStep2'])->name('register.step2.store');
});

Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register'])->name('register.store');
Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit'])->name('weight_target.edit');
Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])->name('weight_target.update');

Route::get('/weight_logs/create', [App\Http\Controllers\WeightLogController::class, 'create'])->name('weight_logs.create');
Route::post('/weight_logs', [App\Http\Controllers\WeightLogController::class, 'store'])->name('weight_logs.store');
