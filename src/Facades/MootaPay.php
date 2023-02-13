<?php

namespace Otnansirk\Moota\Facades;

use Illuminate\Support\Facades\Facade;

class MootaPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MootaPay';
    }
}
