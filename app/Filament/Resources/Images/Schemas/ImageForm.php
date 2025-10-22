<?php

namespace App\Filament\Resources\Images\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('filename')
                    ->required()
                    ->directory('products') 
                    ->disk('public') 
                    ->image(),
                Select::make('watch_id')
    ->relationship(name: 'watch', titleAttribute: 'name'),
                
            ]);
    }
}

