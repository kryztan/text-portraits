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

    public function workoutprocess(Request $request)
    {
        $response = '123';
        $response .= $request->yo;

        $workouts = DB::table('workouts')->get();

        return response()->json([
            'message' => '123',
            'workouts' => $workouts,
        ]);
    }
}
