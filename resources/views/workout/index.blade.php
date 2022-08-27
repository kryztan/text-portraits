<x-layout>
    <textarea class="workouts" name="workouts" rows="5 cols="50"></textarea>
    <button type="button" class="submit">Submit!</button>

    <div style="margin: 30px">
        <table class="table table-bordered table-light">
            <tr>
                <td colspan="3">Workout 7 29 22</td>
            </tr>
            <tr>
                <td rowspan="3">bench press</td>
                <td>45w</td>
                <td>10r</td>
            </tr>
            <tr>
                <td>50w</td>
                <td>9r</td>
            </tr>
            <tr>
                <td>50w</td>
                <td>10r</td>
            </tr>
            <tr>
                <td rowspan="3">barbell row</td>
                <td>45w</td>
                <td>12r -desc</td>
            </tr>
            <tr>
                <td>50w</td>
                <td>8r -desc</td>
            </tr>
            <tr>
                <td>45w</td>
                <td>12r</td>
            </tr>
        </table>

        @foreach ($workouts as $workout)
            <table class="table table-bordered table-light">
                <tr>
                    <td colspan="3">{{ $workout->name }}</td>
                </tr>
                @if ($loop->first)
                    @foreach ($workout->workoutExercises as $workout_exercise)
{{--                        @foreach ($workout_exercise->workout_exercise_sets as $workout_exercise_sets)--}}
{{--                            <tr>--}}
{{--                                @if ($workout_exercise_sets->number === 1)--}}
{{--                                    <td rowspan="{{ count($workout_exercise) }}">{{ $workout_exercise->exercise }}</td>--}}
{{--                                @endif--}}
{{--                                <td>{{ $workout_exercise_sets->weight }}</td>--}}
{{--                                <td>{{ $workout_exercise_sets->reps }} {{ $workout_exercise_sets->description }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                    @endforeach
                @endif
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
