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
use Illuminate\Support\Str;

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
        $query = array_merge(
            [
                'accessEquipment' => [],
                'dealTypes' => [],
                'page' => 1,
                'regions' => [],
                'venueTypes' => [],
                'seatsMin' => null,
                'seatsMax' => null,
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

        $minMaxValues = [
            'seats' => "maximum_seats",
            'wheelchairSeats' => "maximum_wheelchair_seats",
            'maximumStageWidth' => "maximum_stage_width",
            'maximumStageHeight' => "maximum_stage_height",
            'maximumStageDepth' => "maximum_stage_depth",
            'dressingRooms' => "number_of_dressing_rooms",
        ];

        foreach($minMaxValues as $key => $col) {
            $keyMin = "{$key}Min";
            $keyMax = "{$key}Max";
            if (isset($query[$keyMin])) {
                $venues = $venues->where($col, '>=', $query[$keyMin]);
            }
            if (isset($query[$keyMax])) {
                $venues = $venues->where($col, '<=', $query[$keyMax]);
            }
        }


        $venuePaginator = $venues->paginate(Venue::PER_PAGE);

        return inertia(
            'Venue/Index',
            $this->getVenueRelatedItems([
                'venuePaginator' => $venuePaginator,
                'query' => $query,
                'minMaxValues' => array_map(
                    function(string $str) {
                        $str = Str::title($str);
                        return Str::replace('_', ' ', $str);
                    },
                    $minMaxValues
                    )
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
        $venue->load(['accessEquipment', 'dealTypes', 'assets']);

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
