<?php
namespace App\Strategies\Comparisons;

use App\Models\Search;

class HumidityComparison implements ComparisonStrategy
{
    public function compare(Search $search1, Search $search2): string
    {
        // Regra de negócio
        $difference = $search1->humidity - $search2->humidity;
        if ($difference > 0) {
            return "A umidade da localidade '{$search1->name}' é " . abs($difference) . "% maior que da localidade '{$search2->name}'";
        } elseif ($difference < 0) {
            return "A umidade da localidade '{$search1->name}' é " . abs($difference) . "% menor que da localidade '{$search2->name}'";
        } else {
            return "A umidade das localidades '{$search1->name}' e '{$search2->name}' é a mesma.";
        }
    }
}
