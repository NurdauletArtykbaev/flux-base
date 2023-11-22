<?php
return [
    'table_names'=> [
        'category' => 'categories',
        'banner' => 'banners',
        'city' => 'cities',
    ],
    'models' => [
        'catalog' => \Nurdaulet\FluxBase\Models\Catalog::class,
        'partner' => \Nurdaulet\FluxBase\Models\Partner::class,
        'click_history' => \Nurdaulet\FluxBase\Models\ClickHistory::class,
        'user' => \Nurdaulet\FluxBase\Models\User::class,
        'support' => \Nurdaulet\FluxBase\Models\Support::class,
        'banner' => \Nurdaulet\FluxBase\Models\Banner::class,
        'complaint_reason' => \Nurdaulet\FluxBase\Models\ComplaintReason::class,
        'mobile_version' => \Nurdaulet\FluxBase\Models\MobileVersion::class,
        'temp_image' => \Nurdaulet\FluxBase\Models\TemproryImage::class,
        'city' => \Nurdaulet\FluxBase\Models\City::class,
        'type_organization' => \Nurdaulet\FluxBase\Models\TypeOrganization::class,
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
