<?php

namespace App\Filament\Widgets;

use App\Helpers\AdViewHistoryHelper;
use App\Models\ClickHistory;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class WClickStoreOrderHistoryChart extends LineChartWidget
{
    protected static ?string $heading = 'Клики заказов';

    public ?string $filter = 'today';

    protected static ?array $options = [
        'scales' => [
            'y' => [
                'min' => 0,
                'stacked' => true,
            ]
        ],
        'plugins' => [
            'legend' => [
                'display' => true,
                'labels' => [
                    'maxWidth'=> 10
                ]
            ],
        ],
    ];

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = Trend::query(
            ClickHistory::query()->where('name', '=', AdViewHistoryHelper::STORE_ORDER)
        );

        switch ($activeFilter) {
            case('today'):
                $data = $data->between(
                        start: now()->subDays(7)->startOfWeek(),
                        end: now(),
                    )
                    ->perDay();
                break;

            case('month'):
                $data = $data->between(
                        start: now()->startOfYear(),
                        end: now()->endOfYear(),
                    )
                    ->perMonth();
                break;

            case('year'):
                $data = $data->between(
                    start: now()->subYears(5),
                    end: now(),
                )->perYear();
                break;

        }
        $data = $data->count();

        return [
            'datasets' => [
                [
                    'label' => 'Клики заказов',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Дни',
            'month' => 'Месяца',
            'year' => 'Года',
        ];
    }
}
