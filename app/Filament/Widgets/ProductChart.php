<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ProductChart extends ChartWidget
{
    protected ?string $heading = 'Product Chart';

    protected static ?int $sort = 3;


    protected function getData(): array
    {
        $data = $this->getProductPerMonth();

        return [
            "datasets" => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data['productPerMonth']
                ]
            ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getProductPerMonth(): array
    {

        $now = Carbon::now();
        $productPerMonth = [];
        $months = [];
        foreach (range(1, 12) as $month) {
            $count = Product::query()
                ->whereYear('created_at', $now->year)
                ->whereMonth('created_at', $month)
                ->count();
            $productPerMonth[] = $count;
            $months[] = Carbon::createFromDate($now->year, $month, 1)->format('M');
        }
        return [
            'productPerMonth' => $productPerMonth,
            'months' =>  $months
        ];
    }
}
