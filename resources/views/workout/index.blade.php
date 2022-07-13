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

    $('.submit').click(function() {
        $.ajax({
            type: "POST",
            url: '/workoutprocess',
            data: { yo: 8 },
            dataType: "json"
        }).done(function(data) {
            let response = $.parseJSON(data);

            console.log(response);
            alert(response.message);
        });
    });
</script>
