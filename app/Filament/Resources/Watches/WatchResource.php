<?php

namespace App\Filament\Resources\Watches;

use App\Filament\Resources\Watches\Pages\CreateWatch;
use App\Filament\Resources\Watches\Pages\EditWatch;
use App\Filament\Resources\Watches\Pages\ListWatches;
use App\Filament\Resources\Watches\Schemas\WatchForm;
use App\Filament\Resources\Watches\Tables\WatchesTable;
use App\Models\Watch;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WatchResource extends Resource
{
    protected static ?string $model = Watch::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Watch';

    public static function form(Schema $schema): Schema
    {
        return WatchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WatchesTable::configure($table);
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
            'index' => ListWatches::route('/'),
            'create' => CreateWatch::route('/create'),
            'edit' => EditWatch::route('/{record}/edit'),
        ];
    }
}
