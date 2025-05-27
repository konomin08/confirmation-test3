<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'date',
        'recorded_at',
        'calories',
        'exercise_time',
        'exercise_content',
    ];
    protected $casts = [
        'recorded_at' => 'datetime',
    ];
    protected $dates = ['recorded_at'];
}
