<!DOCTYPE html>

<head>
    <title>{{ $pdfTitle }}</title>
</head>

<body>
    <h1>{{ $venue->name }}</h1>

    <h2>Description</h2>
    <p>{{ $venue->description }}</p>

    <h2>Notes</h2>
    <p>{{ $venue->notes }}</p>

    <h2>Some Statistics</h2>
    <table border="1" cellspacing="0" cellpadding="10">
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
            <td>{{ $venue->maximum_seats }}</td>
        </tr>
        <tr>
            <td>Maximum Wheelchair Seats</td>
            <td>{{ $venue->maximum_wheelchair_seats }}</td>
        </tr>
        <tr>
            <td>Dressing Rooms</td>
            <td>{{ $venue->number_of_dressing_rooms }}</td>
        </tr>
        <tr>
            <td>Can you get wheelchairs backstage?</td>
            <td>{{ $venue->backstage_wheelchair_access ? 'Yes' : 'No' }}</td>
        </tr>
    </table>

    <h2>Access Equipment</h2>
    @if (count($venue->accessEquipment) > 0)
        <ul>
            @foreach ($venue->accessEquipment as $access)
                <li>{{ $access->name }}: {{ $access->pivot->notes ?? 'No Notes' }}</li>
            @endforeach
        </ul>
    @else
        <p>This venue has no Access Equipment</p>
    @endif

    <h2>Deal Types</h2>
    @if (count($venue->dealTypes) > 0)
        <ul>
            @foreach ($venue->dealTypes as $dealType)
                <li>{{ $dealType->name }}: {{ $dealType->pivot->notes ?? 'No Notes' }}</li>
            @endforeach
        </ul>
    @else
        <p>This venue has no Deal Types available</p>
    @endif
</body>

<style>
    html {
        font-family: sans-serif;
    }

    table {
        width: 100%;
    }

    td:first-of-type {
        width: 75%;
    }
</style>

</html>
