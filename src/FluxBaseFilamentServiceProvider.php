<?php

namespace Nurdaulet\FluxBase;


use Filament\PluginServiceProvider;
use Nurdaulet\FluxBase\Filament\Resources\BannerResource;
use Nurdaulet\FluxBase\Filament\Resources\CityResource;
use Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource;
use Nurdaulet\FluxBase\Filament\Resources\MobileAppResource;
use Nurdaulet\FluxBase\Filament\Resources\PartnerResource;
use Nurdaulet\FluxBase\Filament\Resources\RatingResource;
use Nurdaulet\FluxBase\Filament\Resources\RentTypeResource;
use Nurdaulet\FluxBase\Filament\Resources\SupportResource;
use Nurdaulet\FluxBase\Filament\Widgets\WClickPhoneHistoryChart;
use Spatie\LaravelPackageTools\Package;

class FluxBaseFilamentServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        BannerResource::class,
        CityResource::class,
        RatingResource::class,
        ComplaintReasonResource::class,
        RentTypeResource::class,
        MobileAppResource::class,
        SupportResource::class,
        PartnerResource::class,
    ];
    protected array $widgets = [
        WClickPhoneHistoryChart::class,
    ];

    public function configurePackage(Package $package): void
    {
        $this->packageConfiguring($package);
        $package->name('base-package');
    }
}