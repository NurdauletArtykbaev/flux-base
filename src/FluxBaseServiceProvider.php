<?php

namespace Nurdaulet\FluxBase;


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
use Nurdaulet\FluxBase\Services\CityService;
use Nurdaulet\FluxBase\Services\ReviewService;
use Nurdaulet\FluxBase\Services\Search\Contracts\SearchEngineContract;
use Nurdaulet\FluxBase\Services\Search\Engines\Algolia\AlgoliaService;
use Nurdaulet\FluxBase\Services\Search\Engines\Meili\MeiliService;
use Nurdaulet\FluxBase\Services\Search\SearchService;

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
        $this->app->bind('fluxBaseCity', CityService::class);

        $this->app->bind(SearchEngineContract::class, function ($app) {
            $engine = config('scout.driver', 'algolia');

            if ($engine === 'algolia') {
                return new AlgoliaService();
            } elseif ($engine === 'meilisearch') {
                return new MeiliService();
            }
            return new AlgoliaService();
        });
        $this->app->bind('fluxBaseSearch', SearchService::class);
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/flux-base.php' => config_path('flux-base.php'),
        ], 'flux-base-config');


//        if (!file_exists(config_path('flux-base.php'))) {
//            Artisan::call('vendor:publish', ['--tag' => 'flux-base-config']);
//        }
    }

    protected function publishMigrations()
    {

        $this->publishes([
            __DIR__ . '/../database/migrations/check_type_organizations.php.stub' => $this->getMigrationFileName('00','check_flux_base_type_organizations.php'),
            __DIR__ . '/../database/migrations/check_countries_table.php.stub' => $this->getMigrationFileName('01','check_flux_base_countries_table.php'),
            __DIR__ . '/../database/migrations/check_cities_table.php.stub' => $this->getMigrationFileName('02','check_flux_base_cities_table.php'),
            __DIR__ . '/../database/migrations/check_mobile_versions_table.php.stub' => $this->getMigrationFileName('03','check_flux_base_mobile_versions_table.php'),
            __DIR__ . '/../database/migrations/check_rent_types_table.php.stub' => $this->getMigrationFileName('04','check_flux_base_rent_types_table.php'),
            __DIR__ . '/../database/migrations/check_complaint_reasons_table.php.stub' => $this->getMigrationFileName('05','check_flux_base_complaint_reasons_table.php'),
            __DIR__ . '/../database/migrations/check_users_table.php.stub' => $this->getMigrationFileName('06','check_flux_base_users_table.php'),
            __DIR__ . '/../database/migrations/check_supports_table.php.stub' => $this->getMigrationFileName('07','check_flux_base_supports_table.php'),
            __DIR__ . '/../database/migrations/check_support_files_table.php.stub' => $this->getMigrationFileName('08','check_flux_base_support_files_table.php'),
            __DIR__ . '/../database/migrations/check_banners_table.php.stub' => $this->getMigrationFileName('09','check_flux_base_banners_table.php'),
            __DIR__ . '/../database/migrations/check_click_histories_table.php.stub' => $this->getMigrationFileName('10','check_flux_base_click_histories_table.php'),
            __DIR__ . '/../database/migrations/check_partners_table.php.stub' => $this->getMigrationFileName('11','check_flux_base_partners_table.php'),
            __DIR__ . '/../database/migrations/check_partner_cities_table.php.stub' => $this->getMigrationFileName('12','check_flux_base_partner_cities_table.php'),
            __DIR__ . '/../database/migrations/check_ratings_table.php.stub' => $this->getMigrationFileName('13','check_flux_base_ratings_table.php'),
            __DIR__ . '/../database/migrations/check_rating_messages_table.php.stub' => $this->getMigrationFileName('14','check_flux_base_rating_messages_table.php'),
            __DIR__ . '/../database/migrations/check_reviews_table.php.stub' => $this->getMigrationFileName('15','check_flux_base_reviews_table.php'),
            __DIR__ . '/../database/migrations/check_review_rating_message_table.php.stub' => $this->getMigrationFileName('16','check_flux_base_review_rating_message_table.php'),
            __DIR__ . '/../database/migrations/check_temprory_images_table.php.stub' => $this->getMigrationFileName('17','check_flux_base_temprory_images_table.php'),
            __DIR__ . '/../database/migrations/check_layouts_table.php.stub' => $this->getMigrationFileName('18','check_flux_base_layouts_table.php'),
            __DIR__ . '/../database/migrations/check_web_site_configs_table.php.stub' => $this->getMigrationFileName('19','check_flux_base_web_site_configs_table.php'),
            __DIR__ . '/../database/migrations/check_links_table.php.stub' => $this->getMigrationFileName('20','check_flux_base_links_table.php'),
            __DIR__ . '/../database/migrations/check_payment_methods_table.php.stub' => $this->getMigrationFileName('21','check_flux_base_payment_methods_table.php'),
            __DIR__ . '/../database/migrations/check_search_synonyms_table.php.stub' => $this->getMigrationFileName('22','check_flux_base_search_synonyms_table.php'),
            __DIR__ . '/../database/migrations/check_banned_top_search_words_table.php.stub' => $this->getMigrationFileName('22','check_flux_base_banned_top_search_words_table.php'),
        ], 'flux-base-migrations');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName($index, string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His','1638640800');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR])
            ->flatMap(fn($path) => $filesystem->glob($path . '*_' . $migrationFileName))
            ->push($this->app->databasePath() . "/migrations/{$timestamp}{$index}_{$migrationFileName}")
            ->first();
    }
}