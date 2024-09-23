<?php

namespace App\Strategies\Comparisons;

use App\Models\Search;

class TemperatureComparison implements ComparisonStrategy
{
    public function compare(Search $search1, Search $search2): string
    {
        // Regra de negócio
        $difference = $search1->temperature - $search2->temperature;
        if ($difference > 0) {
            return "A temperatura da localidade '{$search1->name}' é " . abs($difference) . "°C mais quente que da localidade '{$search2->name}'";
        } elseif ($difference < 0) {
            return "A temperatura da localidade '{$search1->name}' é " . abs($difference) . "°C mais fria que da localidade '{$search2->name}'";
        } else {
            return "A temperatura das localidades '{$search1->name}' e '{$search2->name}' é a mesma.";
        }
    }
}
