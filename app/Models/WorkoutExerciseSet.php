<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExerciseSet extends Model
{
    use HasFactory;

    public function workoutExercise()
    {
        return $this->belongsTo(WorkoutExercise::class);
    }
}
