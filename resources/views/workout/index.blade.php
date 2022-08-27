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
    </div>
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

    console.log(<?= json_encode($workouts) ?>);
</script>
