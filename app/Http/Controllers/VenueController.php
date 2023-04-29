<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\AccessEquipment;
use App\Models\Area;
use App\Models\DealType;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
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
                'regions' => []
            ],
            $request->input()
        );

        $venues = Venue::query()
            ->withAccessEquipment($query['accessEquipment'])
            ->withDealTypes($query['dealTypes']);

        if (is_array($query['regions']) && count($query['regions'])) {
            $venues = $venues->whereIn('region_id', $query['regions']);
        }

        $venuePaginator = $venues->paginate(Venue::PER_PAGE);
        $accessEquipment = AccessEquipment::all();
        $dealTypes = DealType::all();
        $areas = Area::all()->load('regions');

        return inertia(
            'Venue/Index',
            compact(
                'venuePaginator',
                'query',
                'dealTypes',
                'accessEquipment',
                'areas'
            )
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
    public function show(Venue $venue)
    {
        $venue->load(['accessEquipment', 'dealTypes']);

        return inertia('Venue/Show', ['venue' => $venue]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        //
    }
}
