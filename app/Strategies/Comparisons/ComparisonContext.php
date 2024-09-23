<?php

namespace App\Strategies\Comparisons;

use App\Models\Search;

class ComparisonContext
{
    protected $strategy;

    // Define a estratégia de comparação a ser usada
    public function setStrategy(ComparisonStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    // Realiza a comparação
    public function compare(Search $search1, Search $search2): string
    {
        return $this->strategy->compare($search1, $search2);
    }
}
