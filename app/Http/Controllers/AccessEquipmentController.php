<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccessEquipmentRequest;
use App\Http\Requests\UpdateAccessEquipmentRequest;
use App\Models\AccessEquipment;

class AccessEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('AccessEquipment/Index', ['accessEquipment' => AccessEquipment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AccessEquipment/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccessEquipmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessEquipment $accessEquipment)
    {
        return view('AccessEquipment/Show', compact('accessEquipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccessEquipment $accessEquipment)
    {
        return view('AccessEquipment/Edit', compact('accessEquipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccessEquipmentRequest $request, AccessEquipment $accessEquipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessEquipment $accessEquipment)
    {
        //
    }
}
