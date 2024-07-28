<?php

namespace App\Http\RealStats\Services;

use App\Http\RealStats\Contracts\MatcherContract;
use App\Models\Property;
use App\Models\SearchProfile;

class MatcherService implements MatcherContract
{

    public function match($property)
    {
        // TODO: Implement match() method.

        $searchProfiles = SearchProfile::where('property_type_id', $property->property_type_id)->get();

        $matches = [];

        foreach ($searchProfiles as $searchProfile) {
            $matchResult = $this->matchPropertyToSearchProfile($property, $searchProfile);
            if ($matchResult) {
                $matches[] = $matchResult;
            }
        }

        usort($matches, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return ['data' => $matches];
    }

    private function matchPropertyToSearchProfile($property, $searchProfile)
    {
        $propertyFields = $property->getPropertyFieldsAsArray();
        $searchFields = $searchProfile->getSearchFieldsAsArray();

        $strictMatchesCount = 0;
        $looseMatchesCount = 0;
        $totalMatchableFields = 0;

        foreach ($searchFields as $field => $value) {
            // check property field exists in search profile in not exists continue with next filed
            if (!isset($propertyFields[$field])) {
                continue;
            }

            $totalMatchableFields++;
            $propertyValue = $propertyFields[$field];

            $min = $value['min_value'] ?? null;
            $max = $value['max_value'] ?? null;

            if ($this->isInRange($propertyValue, $min, $max)) {
                $strictMatchesCount++;
            } elseif ($this->isInLooseRange($propertyValue, $min, $max)) {
                $looseMatchesCount++;
            } else {
                return null; // No matches at all
            }
        }

        if ($strictMatchesCount + $looseMatchesCount == 0) {
            return null; // No matches at all, exclude this search profile
        }

        $score = ($strictMatchesCount * 1.0 + $looseMatchesCount * 0.75) / $totalMatchableFields;

        return [
            'searchProfileId' => $searchProfile->id,
            'score' => $score,
            'strictMatchesCount' => $strictMatchesCount,
            'looseMatchesCount' => $looseMatchesCount,
        ];
    }

    private function isInRange($value, $min, $max)
    {
        if ($min !== null && $value < $min) {
            return false;
        }
        if ($max !== null && $value > $max) {
            return false;
        }
        return true;
    }

    private function isInLooseRange($value, $min, $max)
    {
        $looseMin = $min !== null ? $min * 0.75 : null; //333
        $looseMax = $max !== null ? $max * 1.25 : null; //1,097.5

        return $this->isInRange($value, $looseMin, $looseMax);
    }
}
