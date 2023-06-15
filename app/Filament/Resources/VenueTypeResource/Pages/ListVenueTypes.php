<?php

namespace App\Filament\Resources\VenueTypeResource\Pages;

use App\Filament\Resources\VenueTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVenueTypes extends ListRecords
{
    protected static string $resource = VenueTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
