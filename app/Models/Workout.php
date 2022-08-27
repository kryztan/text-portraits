<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
}
