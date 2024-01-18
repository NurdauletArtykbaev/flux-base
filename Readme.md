Установите пакет с помощью Composer:

``` bash
 composer require nurdaulet/flux-base
```

## Конфигурация
После установки пакета, вам нужно опубликовать конфигурационный файлы. Вы можете сделать это с помощью следующей команды:
``` bash
php artisan vendor:publish --provider="Nurdaulet\FluxBase\FluxBaseServiceProvider"
php artisan vendor:publish --tag flux-base-config

```

Вы можете самостоятельно добавить поставщика услуг административной панели Filament в файл config/app.php.
``` php
'providers' => [
    // ...
    Nurdaulet\FluxBase\FluxBaseFilamentServiceProvider::class,
];
```



По умолчанию все разделы будут добавлены, вы также можете самостоятельно добавить разделы в админ-панели Filament в
файле AppServiceProvider.php.

```
Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
    return $builder
        ->groups([
            NavigationGroup::make('Главная')
                ->items([
                //...
                ...BannerResource::class,
        ]),
    ]);
});
```

Список всех ресурсов
``` php
[
    BannerResource::class,
    CityResource::class,
    RatingResource::class,
    ComplaintReasonResource::class,
    RentTypeResource::class,
    MobileAppResource::class,
    SupportResource::class,
    PartnerResource::class,
]
```
