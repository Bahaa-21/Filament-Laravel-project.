<?php

namespace App\Filament\Widgets;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make("Total Products", Product::count()),

            Stat::make("Total Customers", User::count())
                ->description('Total Customers in App')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),


            Stat::make("Total Orders", Order::query()->where('status', OrderStatusEnum::PENDING->value)->count())
                ->description('Total Created Orders in App')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([1, 2, 8, 6, 5, 5, 4, 5, 8, 9, 8, 10, 15, 11, 12, 13, 19, 18, 20]),

        ];
    }
}
