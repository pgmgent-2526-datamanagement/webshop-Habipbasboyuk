<?php

namespace App\Filament\Resources\Watches\Pages;

use App\Filament\Resources\Watches\WatchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWatch extends EditRecord
{
    protected static string $resource = WatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
