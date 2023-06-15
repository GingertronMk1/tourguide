<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VenueResource\Pages;
use App\Filament\Resources\VenueResource\RelationManagers;
use App\Models\Venue;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('venue_type_id')
                    ->relationship('venueType', 'name')
                    ->required(),
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Textarea::make('notes'),
                Forms\Components\Textarea::make('street_address'),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('maximum_stage_width'),
                Forms\Components\TextInput::make('maximum_stage_depth'),
                Forms\Components\TextInput::make('maximum_stage_height'),
                Forms\Components\TextInput::make('maximum_seats'),
                Forms\Components\TextInput::make('maximum_wheelchair_seats'),
                Forms\Components\TextInput::make('number_of_dressing_rooms'),
                Forms\Components\Toggle::make('backstage_wheelchair_access'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('venueType.name'),
                Tables\Columns\TextColumn::make('region.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('street_address'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('maximum_stage_width'),
                Tables\Columns\TextColumn::make('maximum_stage_depth'),
                Tables\Columns\TextColumn::make('maximum_stage_height'),
                Tables\Columns\TextColumn::make('maximum_seats'),
                Tables\Columns\TextColumn::make('maximum_wheelchair_seats'),
                Tables\Columns\TextColumn::make('number_of_dressing_rooms'),
                Tables\Columns\IconColumn::make('backstage_wheelchair_access')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
