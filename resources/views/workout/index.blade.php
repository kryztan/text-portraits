<x-layout>
    <textarea class="workouts" name="workouts" rows="5 cols="50"></textarea>

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
            console.log(data);
        });
    });
</script>
