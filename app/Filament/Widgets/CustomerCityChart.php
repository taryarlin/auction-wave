<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Widgets\ChartWidget;

class CustomerCityChart extends ChartWidget
{
    protected static ?string $heading = 'City By Customer Chart';
    protected static ?int $sort=2;

    protected function getData(): array
    {
        $customers = Customer::selectRaw("
            CASE
                WHEN address = 'Yangon' THEN 'Yangon'
                WHEN address = 'Naypyitaw' THEN 'Naypyitaw'
                WHEN address = 'Nay Pyi Taw' THEN 'Naypyitaw'
                WHEN address = 'Mandalay' THEN 'Mandalay'
                ELSE 'Others'
            END as city_group,
            COUNT(*) as count
        ")
        ->groupBy('city_group')
        ->get();

        $labels = $customers->pluck('city_group')->toArray();
        $data = $customers->pluck('count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Customers by City',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(106, 90, 205, 1)',  // Yangon - Red
                        'rgba(60, 179, 113, 1)',  // Naypyitaw - Blue
                        'rgba(255, 165, 0, 1)',  // Mandalay - Yellow
                        'rgba(255, 255, 0, 1)',  // Others - Green
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
