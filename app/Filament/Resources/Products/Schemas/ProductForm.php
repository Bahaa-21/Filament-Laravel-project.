<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enum\ProductStatusEnum;
use App\Filament\Tables\CategoryTabel;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('description')
                    ->label('Decsription')
                    ->nullable()
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options(ProductStatusEnum::class)
                    ->required(),
                ModalTableSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->tableConfiguration(CategoryTabel::class)

            ]);
    }
}
