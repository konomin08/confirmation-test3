<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeightTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_weight',
    ];
}
