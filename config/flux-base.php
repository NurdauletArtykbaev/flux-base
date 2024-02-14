<?php

use Nurdaulet\FluxBase\Filters\ComplaintReasonFilter;

return [

    'models' => [
        'catalog' => \Nurdaulet\FluxBase\Models\Catalog::class,
        'country' => \Nurdaulet\FluxBase\Models\Country::class,
        'partner' => \Nurdaulet\FluxBase\Models\Partner::class,
        'click_history' => \Nurdaulet\FluxBase\Models\ClickHistory::class,
        'user' => \Nurdaulet\FluxBase\Models\User::class,
        'support' => \Nurdaulet\FluxBase\Models\Support::class,
        'rent_type' => \Nurdaulet\FluxBase\Models\RentType::class,
        'banner' => \Nurdaulet\FluxBase\Models\Banner::class,
        'complaint_reason' => \Nurdaulet\FluxBase\Models\ComplaintReason::class,
        'mobile_version' => \Nurdaulet\FluxBase\Models\MobileVersion::class,
        'temp_image' => \Nurdaulet\FluxBase\Models\TemproryImage::class,
        'city' => \Nurdaulet\FluxBase\Models\City::class,
        'link' => \Nurdaulet\FluxBase\Models\Link::class,
        'type_organization' => \Nurdaulet\FluxBase\Models\TypeOrganization::class,
        'web_site_config' => \Nurdaulet\FluxBase\Models\WebSiteConfig::class,
        'info_balance' => \Nurdaulet\FluxBase\Models\InfoBalance::class,
        'layout' => \Nurdaulet\FluxBase\Models\Layout::class,
        'rating' => \Nurdaulet\FluxBase\Models\Rating::class,
        'payment_method' => \Nurdaulet\FluxBase\Models\PaymentMethod::class,
        'search_synonym' => \Nurdaulet\FluxBase\Models\SearchSynonym::class,
        'banned_top_search_word' => \Nurdaulet\FluxBase\Models\BannedTopSearchWord::class,
    ],
    'languages' => [
        'ru', 'en', 'kk'
    ],
    'filters' => [
        'complaint_reason' => ComplaintReasonFilter::class
    ],
    'options' => [
        'yandex_maps_api_key' => env('YANDEX_MAPS_API_KEY'),
        'support_email' => 'info@mail.ru',
        'use_filament_admin_panel' => true,
        'use_list_items_count' => false,
        'cache_expiration' => 269746
    ],
];
