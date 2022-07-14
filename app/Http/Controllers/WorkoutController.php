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

        // Parse text
        $exercises = [];
        $curr_exercise_index = -1;
        $exercise_sets = [];
        $before_exercise = false;
        $before_set = false;
        foreach ($lines as $index => $line) {
            $line = trim($line);

            // Empty line
            if ($line == "") {
                $before_exercise = true;
                $before_set = false;
                continue;
            }
            // Get workout name
            if ($index === array_key_first($lines)) {
                $name = $line;
                continue;
            } elseif (!isset($name)) {
                // No workout name
                break;
            }

            // Get exercise
            if ($before_exercise) {
                $exercises[] = $line;
                $curr_exercise_index++;
                $exercise_sets[$curr_exercise_index] = [];

                $before_exercise = false;
                $before_set = true;
            } elseif ($before_set) {
                // Get exercise set
                $exercise_sets[$curr_exercise_index][] = [
                    'set' => $line
                ];
            }
        }

        // Insert workout
        if (isset($name)) {
            $dateArr = explode(" ", $name);
            $date = "20" . $dateArr[3] . "-" . $dateArr[1] . "-" . $dateArr[2];

            $workout_id = DB::table('workouts')->insertGetId([
                'user_id' => 1,
                'name' => $name,
                'date' => $date,
                'description' => $text
            ]);

            // Insert exercises
            if ($workout_id) {
                foreach ($exercises as $eIndex => $exercise) {
                    $workout_exercise_id = DB::table('workout_exercises')->insertGetId([
                        'workout_id' => $workout_id,
                        'exercise_id' => 1,
                        'exercise' => $exercise
                    ]);

                    // Insert sets
                    if ($workout_exercise_id) {
                        foreach ($exercise_sets[$eIndex] as $sIndex => $exercise_set) {
                            $set = $this->parseSet($exercise_set);

                            for ($i = 0; $i < $set['times']; $i++) {
                                DB::table('workout_exercise_sets')->insert([
                                    'workout_exercise_id' => $workout_exercise_id,
                                    'number' => $sIndex + 1 + $i,
                                    'weight' => $set['weight'],
                                    'reps' => $set['reps']
                                ]);
                            }
                        }
                    }
                }
            }
        }

        return response()->json([
            'workout_id' => $workout_id ?? 0,
            'exercises' => $exercises ?? [],
            'exercise_sets' => $exercise_sets ?? [],
            'text' => $text,
        ]);
    }

    function parseSet(string $set) {
        $set = trim($set);
        $setArr = explode(" ", $set);

        $weight = "";
        $reps = 0;
        $times = 1;

        switch (count($setArr)) {
            case 1:
                $reps = str_replace("r", "", $setArr[0]);
                break;
            case 3:
                $times = str_replace("(", "", $setArr[2]);
                $times = str_replace("x)", "", $times);
            case 2:
                $weight = $setArr[0];
                $reps = str_replace("r", "", $setArr[1]);
                break;
        }

        return [
            'weight' => $weight,
            'reps' => $reps,
            'times' => $times
        ];
    }
}
