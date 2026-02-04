<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enum\ProductStatusEnum;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),

                TextColumn::make('name')
                    ->label('Product Name')
                    //->url(fn(Product $record): string => ProductResource::getUrl('view', ['record' => $record]))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->money('USD', 100, 'en')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')->badge(),

                TextColumn::make('quantity'),

                TextColumn::make('sku'),

                TextColumn::make('slug')
                    ->toggleable(),

                IconColumn::make('is_visible')->boolean()
                    ->label('visibility')
                    ->toggleable(),

                IconColumn::make('is_featured')->boolean()
                    ->label('featured')
                    ->toggleable(),

                TextColumn::make('category.name'),

                TextColumn::make('brand.name'),

                TextColumn::make('tags.name')->badge(),

                TextColumn::make('description')
                    ->toggleable(),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->toggleable(),


                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable()

            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name'),

                SelectFilter::make('status')
                    ->options(ProductStatusEnum::class),

                Filter::make('created_from')
                    ->schema([
                        DatePicker::make('created_from'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $data): Builder => $query->whereDate('created_at', '>=', $data)
                            );
                    }),

                Filter::make('created_until')
                    ->schema([
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $data): Builder => $query->whereDate('created_at', '<=', $data)
                            );
                    }),

                TernaryFilter::make('is_visible')
                    ->label('Visibility')
                    ->boolean()
                    ->trueLabel('Only visible product')
                    ->falseLabel('Only hidden product')
                    ->native(false)

            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
