<?php

namespace Nurdaulet\FluxBase\Filament\Widgets;

use Nurdaulet\FluxBase\Helpers\ClickHistoryHelper;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class WClickPhoneHistoryChart extends LineChartWidget
{
    protected static ?string $heading = 'Клики телефонов';

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
                    'maxWidth' => 10
                ]
            ],
        ],
    ];

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = Trend::query(
            config('flux-base.models.click_history')::query()->where('name', '=', ClickHistoryHelper::VIEW_PHONE)
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
                    'label' => 'Клики телефонов',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
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
