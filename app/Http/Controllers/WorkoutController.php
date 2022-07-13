<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return response()->json([
            'message' => '123'
        ]);
    }
}
