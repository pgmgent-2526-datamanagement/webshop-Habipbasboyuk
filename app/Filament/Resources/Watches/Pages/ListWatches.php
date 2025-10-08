<?php

namespace App\Filament\Resources\Watches\Pages;

use App\Filament\Resources\Watches\WatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWatches extends ListRecords
{
    protected static string $resource = WatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
