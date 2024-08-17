<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductsByCategoryChart extends ChartWidget
{
    protected static ?int $sort=3;
    protected static ?string $heading = 'ပစ္စည်းများ၏ အမျိုးအစားခွဲခြားမှုများ';

    protected int | string | array $rowSpan = 2;

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get(); 
        $categoryNames = $categories->pluck('name')->toArray();
        $productCounts = $categories->pluck('products_count')->toArray();
        return [
            'labels' => $categoryNames,
            'datasets' => [
                [
                    'label' => 'Products Count',
                    'data' => $productCounts,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(0, 128, 128, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(94, 60, 108, 0.5)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(128, 0, 0, 0.5)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
    

    protected function getType(): string
    {
        return 'pie';
    }
}
