<?php

namespace Nurdaulet\FluxBase\Helpers;


class PartnerHelper
{
    const VARIANT_PRIMARY = 'primary';
    const VARIANT_SECONDARY = 'secondary';
    public static function getVariants()
    {
        return [
            self::VARIANT_PRIMARY => trans('admin.primary'),
            self::VARIANT_SECONDARY => trans('admin.secondary'),
        ];
    }

}
