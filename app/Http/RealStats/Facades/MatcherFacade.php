<?php

namespace App\Http\RealStats\Facades;

use Illuminate\Support\Facades\Facade;

class MatcherFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'MatcherService';
    }

}
