<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::with([
            'area',
            'venues',
        ])
            ->get()
            ->sortBy('name')
            ->values()
            ->all();

        return inertia('Region/Index', [
            'regions' => $regions,
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
    public function store(StoreRegionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        $region->load(['venues', 'area']);

        return inertia('Region/Show', ['region' => $region]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        //
    }
}
