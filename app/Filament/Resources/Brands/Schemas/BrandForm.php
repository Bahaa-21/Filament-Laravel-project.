<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Brand Name')
                    ->required(),

                TextInput::make('url')
                    ->url()
                    ->label('Web site URL')
                    ->default(null),

                ColorPicker::make('primary_hax')
                    ->label('Primay Color')
                    ->default(null),

                Toggle::make('is_visible')
                    ->label('Visibility')
                    ->required(),

                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
