<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
{
    public function index()
    {
        return view('workout.index');
    }

    public function store(Request $request)
    {
        $text = $request->text;

        $workouts = DB::table('workouts')->get();

        $workout_id = DB::table('workouts')->insertGetId([
            'name' => 'Workout Test',
            'user_id' => 1,
            'description' => $text
        ]);

        return response()->json([
            'workout_id' => $workout_id,
            'text' => $text,
        ]);
    }
}
