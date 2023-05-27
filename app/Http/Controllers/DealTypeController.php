<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreDealTypeRequest;
use App\Http\Requests\UpdateDealTypeRequest;
use App\Models\DealType;

class DealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreDealTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DealType $dealType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DealType $dealType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealTypeRequest $request, DealType $dealType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DealType $dealType)
    {
        //
    }
}
