<!DOCTYPE html>

<head>
    <title>
        {{ $fileName }}
    </title>
</head>

<body>
    <h1>{{ $venue->name }}</h1>

    <h2>Some Statistics</h2>
    <table
        border="1"
        cellspacing="0"
        cellpadding="10"
        id="details-table"
    >
        <tr>
            <td>Area</td>
            <td>{{ $venue->area?->name ?? 'No Area' }}</td>
        </tr>
        <tr>
            <td>Region</td>
            <td>{{ $venue->region?->name ?? 'No Region' }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ $venue->city }}</td>
        </tr>
        <tr>
            <td>Street Address</td>
            <td>{{ $venue->street_address }}</td>
        </tr>
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

    <section>
        <h2>Description</h2>
        <p>{{ $venue->description }}</p>
    </section>

    <section>
        <h2>Notes</h2>
        <p>{{ $venue->notes }}</p>
    </section>

    <section>
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
    </section>

    <section>
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
    </section>

    <h2 id="photos-header">Photos</h2>
    @forelse ($venue->photoAssets as $photoAsset)
        <div class="photo">
            <h4 class="photo-header">
                {{ $photoAsset->title }} | {{ $photoAsset->type }}
            </h4>
            <img
                src="{{ $photoAsset->fileAsBase64 }}"
                width="600"
            />
            <br />
            <a href="{{ $photoAsset->fileAsBase64 }}" target="_blank">Link</a>
        </div>
    @empty
        <h2>No photos for this venue</h2>
    @endforelse
</body>

<style>
    html {
        font-family: sans-serif;
    }

    table {
        width: 100%;
    }

    #details-table td:first-of-type {
        width: 35%;
    }

    img {
        object-fit: scale-down;
    }

    #photos-header {
        page-break-before: always;
    }

    .photo {
        page-break-inside: avoid;
    }

    .photo+.photo {
        margin-top: 10px;
    }

    section {
        page-break-inside: avoid;
    }
</style>

</html>
