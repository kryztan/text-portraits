<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::with('workoutExercises.workoutExerciseSets')
            ->orderByDesc('id')
            ->get();

        return view('workout.index', [
            'workouts' => $workouts
        ]);
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
                $exercise_sets[$curr_exercise_index][] = $line;
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
                        $set_number = 0;

                        foreach ($exercise_sets[$eIndex] as $exercise_set) {
                            $set = $this->parseSet($exercise_set);

                            for ($i = 0; $i < $set['times']; $i++) {
                                $set_number++;

                                if (!empty($set['description'])) {
                                    $description = "";

                                    foreach ($set['description'] as $k => $desc_item) {
                                        $description .= $desc_item;

                                        if ($k != array_key_last($set['description'])) {
                                            $description .= ", ";
                                        }
                                    }
                                } else {
                                    $description = null;
                                }

                                DB::table('workout_exercise_sets')->insert([
                                    'workout_exercise_id' => $workout_exercise_id,
                                    'number' => $set_number,
                                    'weight' => $set['weight'],
                                    'reps' => $set['reps'],
                                    'description' => $description
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
        $weight = "";
        $reps = 0;
        $times = 1;
        $description = [];

        $set = trim($set);
        $setArr = explode("-", $set, 2);

        // Description
        if (count($setArr) == 2) {
            $description[] = $setArr[1];
        }

        $set = trim($setArr[0]);
        $setArr = explode(" ", $set);

        // Sloppy
        if ($setArr[count($setArr) - 1] == "*") {
            array_unshift($description, "sloppy");
            unset($setArr[count($setArr) - 1]);
        }

        // Times
        if ($setArr[count($setArr) - 1][0] == "(") {
            $times = str_replace("(", "", $setArr[count($setArr) - 1]);
            $times = str_replace("x)", "", $times);
            unset($setArr[count($setArr) - 1]);
        }

        // Weight and Reps
        $repsStr = $setArr[0];
        if (count($setArr) == 2) {
            $weight = $setArr[0];
            $repsStr = $setArr[1];
        }
        if (substr($repsStr, -1) == "s") {
            array_unshift($description, "seconds");
        }
        $reps = str_replace("r", "", $repsStr);
        $reps = str_replace("s", "", $reps);

        return [
            'weight' => $weight,
            'reps' => $reps,
            'times' => $times,
            'description' => $description
        ];
    }
}
