<?php

namespace App\Http\Controllers;

use App\Http\RealStats\Facades\MatcherFacade;
use App\Models\Property;

class PropertyController extends Controller
{
    public function match(Property $property)
    {
        return MatcherFacade::match($property);
    }
}
