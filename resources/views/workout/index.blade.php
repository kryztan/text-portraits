<style>
    .workout-tbls-container {
        margin: 0 auto;
        padding: 30px 40px;
        width: 100vw;
        /*max-width: 100%;*/
        max-width: 2000px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .workout-tbl {
        max-width: 300px;
        margin: 15px;
        font-size: 14px;
        border: 1px solid #cbcbcb;
    }
    .workout-tbl tr td {
        padding: 5px;
    }
    .workout-tbl .workout-title {
        text-align: center;
        font-size: 15px;
        background-color: #dfd0ff;
    }
</style>

<x-layout>
    <textarea class="workouts" name="workouts" rows="5 cols="50"></textarea>
    <button type="button" class="submit">Submit!</button>

    <div class="workout-tbls-container">
        @foreach ($workouts as $workout)
            <table class="workout-tbl table table-bordered table-light">
                <tr>
                    <td class="workout-title" colspan="3">{{ $workout->name }}</td>
                </tr>
                @foreach ($workout->workoutExercises as $workout_exercise)
                    @foreach ($workout_exercise->workoutExerciseSets as $workout_exercise_set)
                        <tr>
                            @if ($workout_exercise_set->number === 1)
                                <td rowspan="{{ count($workout_exercise->workoutExerciseSets) }}">{{ $workout_exercise->exercise }}</td>
                            @endif
                            <td>{{ $workout_exercise_set->weight }}</td>
                            <td>{{ $workout_exercise_set->reps }}{{ ($workout_exercise_set->description ? ' - '.$workout_exercise_set->description : '') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @endforeach
    </div>
</x-layout>

<script>
    console.log(<?= json_encode($workouts) ?>);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}"
        }
    });

    $('.submit').click(function() {
        $.ajax({
            type: "POST",
            url: '/workout',
            data: {
                text: $('.workouts').val()
            },
            dataType: "json"
        }).done(function(data) {
            console.log(data);
        });
    });
</script>
