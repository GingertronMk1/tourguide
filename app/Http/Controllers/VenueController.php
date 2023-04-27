<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\AccessEquipment;
use App\Models\DealType;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedAccessEquipmentProp = $request->get('accessEquipment');
        $selectedDealTypesProp = $request->get('dealTypes');

        $venues = Venue::query();

        if (is_array($selectedAccessEquipmentProp) && count($selectedAccessEquipmentProp) > 0) {
            $venues = $venues->whereHas(
                'accessEquipment',
                function(Builder $query) use ($selectedAccessEquipmentProp) {
                    $query->whereIn('access_equipment.id', $selectedAccessEquipmentProp);
                },
                '=',
                count($selectedAccessEquipmentProp)
            );
        }
        if (is_array($selectedDealTypesProp) && count($selectedDealTypesProp) > 0) {
            $venues = $venues->whereHas(
                'dealTypes',
                function(Builder $query) use ($selectedDealTypesProp) {
                    $query->whereIn('deal_types.id', $selectedDealTypesProp);
                },
                '=',
                count($selectedDealTypesProp)
            );
        }

        $venues = $venues->with([
            'region',
            'venueType'
        ]);

        return inertia('Venue/Index', [
            'venues' => $venues->get(),
            'accessEquipment' => AccessEquipment::all(),
            'dealTypes' => DealType::all(),
            'selectedAccessEquipmentProp' => $selectedAccessEquipmentProp,
            'selectedDealTypesProp' => $selectedDealTypesProp
        ]);
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
        $venue->load(['region', 'venueType', 'accessEquipment', 'dealTypes']);
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
