<x-layout>
    <div>Workout</div>

    <textarea id="workouts" name="workouts" rows="5 cols="50">
        Workout 7/5
        bench press
        50w 10r (3x)
    </textarea>

    <button type="button" class="submit">Submit!</button>
</x-layout>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}"
        }
    });

    $('.submit').click(function () {
        console.log(1, 'one');

        $.ajax({
            type: "POST",
            url: '/workoutprocess',
            dataType: "json",
            data: { yo: 7 },
            success: function( response ) {
                console.log(123);
                console.log(response);
                var data = $.parseJSON(response);

                alert(data.message);
            }
        });
    });
</script>
