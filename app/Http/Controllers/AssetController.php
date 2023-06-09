<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AssetTypeEnum;
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request)
    {
        [
            'assetable_type' => $assetableType,
            'assetable_id' => $assetableId,
            'redirect' => $redirect,
        ] = $request->input();
        $file = $request->file('file');
        $path = $file->store('asset');
        if ($path) {
            $asset = new Asset($request->input());
            $asset->mime_type = $file->getMimeType();
            $asset->path = $path;
            if ($asset->save()) {
                if (AssetTypeEnum::MAIN_PHOTO === $asset->type) {
                    Asset::where([
                        ['assetable_type', '=', $assetableType],
                        ['assetable_id', '=', $assetableId],
                        ['id', '<>', $asset->id],
                        ['type', '=', AssetTypeEnum::MAIN_PHOTO],
                    ])
                        ->get()
                        ->each(function (Asset $asset) {
                            $asset->type = AssetTypeEnum::ADDITIONAL_PHOTO;
                            $asset->save();
                        })
                    ;
                }

                return redirect($redirect);
            }
        }

        return 'Unable to save file';
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
    }
}
