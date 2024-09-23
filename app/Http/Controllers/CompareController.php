<?php
namespace App\Http\Controllers;

use App\Models\Search;
use App\Strategies\Comparisons\ComparisonContext;
use App\Services\ComparisonService;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    protected $comparisonService;

    public function __construct(ComparisonService $comparisonService)
    {
        $this->comparisonService = $comparisonService;
    }

    public function compare(Request $request)
    {
        $searchId = $request->input('searchId');
        $compareWithId = $request->input('compareWithId');
        $comparisonType = $request->input('comparisonType');
        // Validação da existencia dos dados
        $search1 = Search::findOrFail($searchId);
        $search2 = Search::findOrFail($compareWithId);
        $comparisonContext = new ComparisonContext();
        // validação da estratégia utilizada
        try {
            $strategy = $this->comparisonService->getStrategy($comparisonType);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        // inserção da estratégia selecionada pelo serviço
        $comparisonContext->setStrategy($strategy);
        // retorno do resultado da estratégia
        $result = $comparisonContext->compare($search1, $search2);
        return response()->json(['result' => $result]);
    }
}
