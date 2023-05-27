<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::with(['regions'])->get()->sortBy('name')->values()->all();

        return inertia('Area/Index', ['areas' => $areas]);
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
    public function store(StoreAreaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        $area->load(['regions']);

        return inertia('Area/Show', ['area' => $area]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
