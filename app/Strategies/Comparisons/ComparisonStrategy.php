<?php
namespace App\Strategies\Comparisons;

use App\Models\Search;

interface ComparisonStrategy
{
       public function compare(Search $search1, Search $search2): string;
}