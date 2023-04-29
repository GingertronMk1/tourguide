<?php

namespace App\Http\Controllers;

use App\Models\AccessEquipment;
use App\Models\DealType;
use App\Models\Region;
use App\Models\Venue;
use Illuminate\Http\Request;

class RegionVenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Region $region, Request $request)
    {
        $selectedAccessEquipmentProp = $request->get('accessEquipment', []);
        $selectedDealTypesProp = $request->get('dealTypes', []);

        $venues = $region
            ->venues()
            ->withAccessEquipment($selectedAccessEquipmentProp)
            ->withDealTypes($selectedDealTypesProp);

        return inertia('Venue/Index', [
            'venuePaginator' => $venues->paginate(Venue::PER_PAGE),
            'accessEquipment' => AccessEquipment::all(),
            'dealTypes' => DealType::all(),
            'selectedAccessEquipmentProp' => $selectedAccessEquipmentProp,
            'selectedDealTypesProp' => $selectedDealTypesProp,
            'region' => $region,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Region $region)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Region $region)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region, Venue $venue)
    {
        return inertia('Venue/Show', [
            'venue' => $venue->load([
                'accessEquipment',
                'dealTypes',
            ]),
            'region' => $region,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region, Venue $venue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region, Venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region, Venue $venue)
    {
        //
    }
}
