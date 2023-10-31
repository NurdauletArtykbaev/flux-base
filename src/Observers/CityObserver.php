<?php

namespace Nurdaulet\FluxBase\Observers;


class CityObserver
{
    public function created($city)
    {
        $city->slug = \TextConverter::translate($city->name);
        $city->save();
    }

    public function updated($city)
    {
        if ($city->slug != \TextConverter::translate($city->name)) {
            $city->slug = \TextConverter::translate($city->name);
            $city->save();
        }
    }
}
