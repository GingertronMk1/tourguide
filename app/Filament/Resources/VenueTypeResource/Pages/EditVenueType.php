<?php

namespace App\Filament\Resources\VenueTypeResource\Pages;

use App\Filament\Resources\VenueTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVenueType extends EditRecord
{
    protected static string $resource = VenueTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
