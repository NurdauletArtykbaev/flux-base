<?php

namespace Nurdaulet\FluxBase\Helpers;


class PaymentHelper
{
    const STATUS_PENDING = 1;
    const STATUS_PAID = 2;
    const STATUS_FAILED = 3;
    const STATUS_REFUND = 4;
    const STATUS_REFUND_FAILED = 'refund_failed';

    const SLUG_CASH = 'cash';
    const SLUG_CARD = 'card';
    const SLUG_ALL = 'all';
    const SLUG_DRAFT = 'draft';


    const ONLINE_EPAY           = 1;
    const ONLINE_CLOUD_PAYMENTS = 12;


    public static function isPaymentOnline($slug): bool
    {
        return in_array($slug, [PaymentHelper::SLUG_CARD]);
    }

    public static function getSlugs()
    {
        return [
            self::SLUG_DRAFT => trans('admin.payment_methods.'. self::SLUG_DRAFT),
            self::SLUG_ALL => trans('admin.payment_methods.' . self::SLUG_ALL),
            self::SLUG_CARD => trans('admin.payment_methods.' . self::SLUG_CARD),
            self::SLUG_CASH => trans('admin.payment_methods.' . self::SLUG_CASH),
        ];
    }
}
