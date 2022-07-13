<x-layout>
    <textarea class="workouts" name="workouts" rows="5 cols="50">
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
            url: '/workout',
            data: {
                text: $('.workouts').val()
            },
            dataType: "json"
        }).done(function(data) {
            // console.log(data);
            // let response = $.parseJSON(data);

            console.log(data);
            alert(data.message);
        });
    });
</script>
