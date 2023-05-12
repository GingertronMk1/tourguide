<!DOCTYPE html>

<body>
    <h1>{{ $venue->name }}</h1>

    <h2>Description</h2>
    <p>{{ $venue->description }}</p>

    <h2>Notes</h2>
    <p>{{ $venue->notes }}</p>

    <h2>Some Statistics</h2>
    <table>
        <tr>
            <td>Stage Width</td>
            <td>{{ $venue->maximum_stage_width }}mm</td>
        </tr>
        <tr>
            <td>Stage Height</td>
            <td>{{ $venue->maximum_stage_height }}mm</td>
        </tr>
        <tr>
            <td>Stage Depth</td>
            <td>{{ $venue->maximum_stage_depth }}mm</td>
        </tr>
        <tr>
            <td>Maximum Seats</td>
            <td>{{$venue->maximum_seats}}</td>
        </tr>
        <tr>
            <td>Maximum Wheelchair Seats</td>
            <td>{{$venue->maximum_wheelchair_seats}}</td>
        </tr>
        <tr>
            <td>Dressing Rooms</td>
            <td>{{$venue->number_of_dressing_rooms}}</td>
        </tr>
        <tr>
            <td>Can you get wheelchairs backstage?</td>
            <td>{{$venue->backstage_wheelchair_access ? 'Yes' : 'No'}}</td>
        </tr>
    </table>
</body>

</html>
