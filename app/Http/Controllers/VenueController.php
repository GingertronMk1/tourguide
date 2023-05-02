<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\AccessEquipment;
use App\Models\Area;
use App\Models\DealType;
use App\Models\Venue;
use App\Models\VenueType;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    private function getVenueRelatedItems(?array $merge = []): array
    {
        return array_merge([
            'dealTypes' => DealType::all(),
            'accessEquipment' => AccessEquipment::all(),
            'areas' => Area::all()->load('regions'),
            'venueTypes' => VenueType::all(),
        ], $merge);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $maximumNumberOfSeats = Venue::orderBy('maximum_seats', 'desc')->value('maximum_seats');
        $query = array_merge(
            [
                'accessEquipment' => [],
                'dealTypes' => [],
                'page' => 1,
                'regions' => [],
                'venueTypes' => [],
                'seatsMin' => 0,
                'seatsMax' => $maximumNumberOfSeats,
            ],
            $request->input()
        );

        $venues = Venue::query()
            ->withAccessEquipment($query['accessEquipment'])
            ->withDealTypes($query['dealTypes']);

        if (is_array($query['regions']) && count($query['regions'])) {
            $venues = $venues->whereIn('region_id', $query['regions']);
        }
        if (is_array($query['venueTypes']) && count($query['venueTypes'])) {
            $venues = $venues->whereIn('venue_type_id', $query['venueTypes']);
        }

        $venuePaginator = $venues
            ->whereBetween(
                'maximum_seats',
                [$query['seatsMin'], $query['seatsMax']]
            )
            ->paginate(Venue::PER_PAGE);

        return inertia(
            'Venue/Index',
            $this->getVenueRelatedItems([
                'venuePaginator' => $venuePaginator,
                'query' => $query,
            ])
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue, Request $request)
    {
        $venue->load(['accessEquipment', 'dealTypes']);

        return inertia(
            'Venue/Show',
            [
                'venue' => $venue,
                'query' => $request->get('query'),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return inertia(
            'Venue/Edit',
            $this->getVenueRelatedItems(['venue' => $venue])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $postData = $request->post();
        $syncAccessEquipment = [];
        $syncDealTypes = [];
        foreach ($postData['access_equipment'] as $ae) {
            $syncAccessEquipment[$ae['access_equipment_id']] = ['notes' => $ae['notes']];
        }
        foreach ($postData['deal_types'] as $dt) {
            $syncDealTypes[$dt['deal_type_id']] = ['notes' => $dt['notes']];
        }
        if ($venue->update($request->post())) {
            $venue->accessEquipment()->sync($syncAccessEquipment);
            $venue->dealTypes()->sync($syncDealTypes);

            return redirect(route('venue.show', $venue));
        }

        return redirect(route('venue.edit', $venue));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        //
    }
}
