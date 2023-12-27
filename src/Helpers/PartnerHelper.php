<?php

namespace Nurdaulet\FluxBase\Helpers;


class PartnerHelper
{
    const VARIANT_PRIMARY = 'primary';
    const VARIANT_MAIN = 'main';
    public static function getVariants()
    {
        return [
            self::VARIANT_PRIMARY => trans('admin.primary'),
            self::VARIANT_MAIN => trans('admin.main'),
        ];
    }

}
