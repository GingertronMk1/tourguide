<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Venue;
use Illuminate\Http\Request;

class RegionVenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Region $region)
    {
        $venues = $region->venues;
        $venues->load([
                'region',
                'venueType'
        ]);
        return inertia(
            'Venue/Index',
            [
                'header' => "Venues in {$region->name}",
                'venues' => $venues
            ]
        );
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
        //
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
