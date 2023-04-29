<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Region;
use Illuminate\Http\Request;

class AreaRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Area $area)
    {
        $regions = $area->regions;
        $regions->load([
            'venues',
        ]);

        return inertia(
            'Region/Index',
            [
                'area' => $area,
                'regions' => $regions,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Area $area)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Area $area)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area, Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area, Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area, Region $region)
    {
        //
    }
}
