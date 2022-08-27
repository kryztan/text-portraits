<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function workoutExerciseSets()
    {
        return $this->hasMany(WorkoutExerciseSet::class);
    }
}
