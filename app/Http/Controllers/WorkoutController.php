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
        $lines = preg_split('/\r\n|\r|\n/', $text);

        $workout_ids = [];

        foreach ($lines as $index => $line) {
            if ($index === array_key_first($lines)) {
                $name = $line;
            }
        }

        if (isset($name)) {
            $workout_id = DB::table('workouts')->insertGetId([
                'name' => $name,
                'user_id' => 1,
                'description' => $text
            ]);

            $workout_ids[] = $workout_id;
        }

        return response()->json([
            'workout_ids' => $workout_ids,
            'text' => $text,
        ]);
    }
}
