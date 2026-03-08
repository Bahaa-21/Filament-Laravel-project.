<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enum\OrderStatusEnum;
use App\Models\Product;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Markdown;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make("Order Step")
                        ->schema([
                            TextInput::make('number')
                                ->default('OR-' . random_int(100000, 9999999))
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            Select::make('user_Id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->required(),

                            TextInput::make('shipping_price')
                                ->label('Shipping Price')
                                ->dehydrated()
                                ->numeric()
                                ->required(),

                            Select::make('status')
                                ->options(OrderStatusEnum::class)
                                ->default(OrderStatusEnum::class::PENDING->value)
                                ->required(),

                            MarkdownEditor::make('nots')
                                ->columnSpanFull(),
                        ])->columns(2),




                    Step::make('Order Items')
                        ->schema([
                            Repeater::make("Items")
                                ->relationship()
                                ->schema([
                                    Select::make('product_id')
                                        ->label("Product")
                                        ->options(Product::query()->pluck('name', 'id'))
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn($state, Set $set) =>
                                        $set('unit_price', Product::find($state)?->price ?? 00)),

                                    TextInput::make("quantity")
                                        ->numeric()
                                        ->live()
                                        ->dehydrated()
                                        ->default(1)
                                        ->required(),

                                    TextInput::make('unit_price')
                                        ->label("Unit Price")
                                        ->disabled()
                                        ->dehydrated()
                                        ->numeric(),

                                    Placeholder::make('total_price')
                                        ->label('Total Price')
                                        ->disabled()
                                        ->content(function ($get) {
                                            return $get('quantity') * $get('unit_price');
                                        })
                                ])->columns(4)
                        ])
                ])->columnSpanFull(),

            ]);
    }
}
