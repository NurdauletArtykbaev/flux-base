<?php
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
    ],
    'languages' => [
        'ru', 'en', 'kk'
    ],
    'options' => [
        'support_email' => 'info@mail.ru',
        'use_filament_admin_panel' => true,
        'use_list_items_count' => false,
        'cache_expiration' => 269746
    ],
];
