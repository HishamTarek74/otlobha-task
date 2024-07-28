<?php

namespace App\Http\RealStats\Contracts;

use App\Models\Property;

interface MatcherContract
{
    public function match(Property $property);
}
