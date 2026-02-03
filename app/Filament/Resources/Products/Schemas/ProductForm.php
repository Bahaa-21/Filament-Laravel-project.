<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enum\ProductStatusEnum;
use App\Filament\Tables\CategoryTabel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->live(true)
                                    ->required()
                                    ->unique()
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    })
                                    ->maxLength(255),

                                TextInput::make('slug')
                                    ->unique()
                                    ->required(),

                                MarkdownEditor::make('description')
                                    ->label('Description')
                                    ->nullable()
                                    ->columnSpan('full'),

                            ])->columns(2)->columnSpan('full'),

                        Section::make('Price & Inventory')
                            ->schema([
                                TextInput::make('sku')
                                    ->unique()
                                    ->required(),

                                TextInput::make('price')
                                    ->label('Price')
                                    ->required()
                                    ->numeric()
                                    ->minLength(0)
                                    ->prefix('$'),



                                Select::make('status')
                                    ->label('Type')
                                    ->options(ProductStatusEnum::class)
                                    ->required(),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->minLength(0)
                            ])->columns(2)->columnSpan('full')
                    ]),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                Toggle::make("is_visible")
                                    ->label('Visibility')
                                    ->default(true),


                                Toggle::make("is_featured")
                                    ->label('Featured')
                                    ->default(true),

                                DatePicker::make('published_at')
                                    ->label('Availability')
                                    ->default(now())
                            ]),

                        Section::make('Image')
                            ->schema([
                                FileUpload::make('image')
                                    ->required()
                                    ->directory('form-attachments')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageEditor()

                            ])->collapsible(),


                        Section::make('Associations')
                            ->schema([

                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->required(),

                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->required(),

                                ModalTableSelect::make('category_id')
                                    ->relationship('category', 'name')
                                    ->tableConfiguration(CategoryTabel::class)
                                    ->required(),

                            ])->columns(2)
                    ]),
            ]);
    }
}
