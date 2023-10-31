<?php

namespace Nurdaulet\FluxBase;


use Nurdaulet\FluxBase\Filament\Resources\BannerResource;
use Nurdaulet\FluxBase\Filament\Resources\CityResource;
use Nurdaulet\FluxBase\Helpers\StringFormatterHelper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Nurdaulet\FluxBase\Helpers\TextConverterHelper;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;
use Nurdaulet\FluxBase\Models\City;
use Nurdaulet\FluxBase\Observers\CityObserver;
use Nurdaulet\FluxBase\Services\ReviewService;

class FluxBaseServiceProvider extends ServiceProvider
{

    public function boot()
    {
        City::observe(new CityObserver());

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishMigrations();
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/flux-base.php',
            'flux-base'
        );
        $this->app->bind('textConverter', TextConverterHelper::class);
        $this->app->bind('stringFormatter', StringFormatterHelper::class);
        $this->app->bind('fluxBaseReview', ReviewService::class);
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/flux-base.php' => config_path('flux-base.php'),
        ], 'flux-base-config');


        if (!file_exists(config_path('flux-base.php'))) {
            Artisan::call('vendor:publish', ['--tag' => 'flux-base-config']);
        }
    }

    protected function publishAdminPanel()
    {
        if (config('flux-catalog.options.use_filament_admin_panel')) {
            Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->groups([
                        NavigationGroup::make('Каталог')->items([
                            ...BannerResource::getNavigationItems(),
                        ]),
                        NavigationGroup::make('Доплонительно')->items([
                            ...CityResource::getNavigationItems(),
                        ]),
                    ]);
            });
        }
    }

    protected function publishMigrations()
    {

        $this->publishes([
            __DIR__ . '/../database/migrations/check_type_organizations.php.stub' => $this->getMigrationFileName('check_type_organizations.php'),
            __DIR__ . '/../database/migrations/check_cities_table.php.stub' => $this->getMigrationFileName('check_cities_table.php'),
            __DIR__ . '/../database/migrations/check_mobile_versions_table.php.stub' => $this->getMigrationFileName('check_mobile_versions_table.php'),
            __DIR__ . '/../database/migrations/check_rent_types_table.php.stub' => $this->getMigrationFileName('check_rent_types_table.php'),
            __DIR__ . '/../database/migrations/check_complaint_reasons_table.php.stub' => $this->getMigrationFileName('check_complaint_reasons_table.php'),
            __DIR__ . '/../database/migrations/check_users_table.php.stub' => $this->getMigrationFileName('check_users_table.php'),
            __DIR__ . '/../database/migrations/check_supports_table.php.stub' => $this->getMigrationFileName('check_supports_table.php'),
            __DIR__ . '/../database/migrations/check_banners_table.php.stub' => $this->getMigrationFileName('check_banners_table.php'),
            __DIR__ . '/../database/migrations/check_click_histories_table.php.stub' => $this->getMigrationFileName('check_click_histories_table.php'),
            __DIR__ . '/../database/migrations/check_partners_table.php.stub' => $this->getMigrationFileName('check_partners_table.php'),
            __DIR__ . '/../database/migrations/check_partner_cities_table.php.stub' => $this->getMigrationFileName('check_partner_cities_table.php'),
            __DIR__ . '/../database/migrations/check_ratings_table.php.stub' => $this->getMigrationFileName('check_ratings_table.php'),
            __DIR__ . '/../database/migrations/check_rating_messages_table.php.stub' => $this->getMigrationFileName('check_rating_messages_table.php'),
            __DIR__ . '/../database/migrations/check_reviews_table.php.stub' => $this->getMigrationFileName('check_reviews_table.php'),
        ], 'flux-base-migrations');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR])
            ->flatMap(fn($path) => $filesystem->glob($path . '*_' . $migrationFileName))
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
