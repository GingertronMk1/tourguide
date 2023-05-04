<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;

class AssetController extends Controller
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
    public function store(StoreAssetRequest $request)
    {
        [
            'type' => $type,
            'assetable_type' => $assetableType,
            'assetable_id' => $assetableId,
            'redirect' => $redirect,
        ] = $request->input();
        $file = $request->file('file');
        $path = $file->store('assets');
        if ($path) {
            $asset = new Asset;
            $asset->assetable_type = $assetableType;
            $asset->assetable_id = $assetableId;
            $asset->type = $type;
            $asset->mime_type = $file->getMimeType();
            $asset->path = $path;
            if ($asset->save()) {
                return redirect($redirect);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
