<?php
namespace App\Strategies\Comparisons;

use App\Models\Search;

class WindSpeedComparison implements ComparisonStrategy
{
    public function compare(Search $search1, Search $search2): string
    {
        // Regra de negócio
        $difference = $search1->wind_speed - $search2->wind_speed;
        if ($difference > 0) {
            return "A velocidade do vento na localidade '{$search1->name}' é " . abs($difference) . " km/h maior que na localidade '{$search2->name}'";
        } elseif ($difference < 0) {
            return "A velocidade do vento na localidade '{$search1->name}' é " . abs($difference) . " km/h menor que na localidade '{$search2->name}'";
        } else {
            return "A velocidade do vento nas localidades '{$search1->name}' e '{$search2->name}' é a mesma.";
        }
    }
}