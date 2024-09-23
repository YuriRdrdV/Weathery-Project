<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    public function saveSearch(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    try {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'searchData.name' => 'required|string',
            'searchData.country' => 'required|string',
            'searchData.region' => 'required|string',
            'searchData.localtime' => 'required|date',
            'searchData.temperature' => 'required|numeric',
            'searchData.feelslike' => 'required|numeric',
            'searchData.weather' => 'required|string',
            'searchData.icon' => 'required|string',
            'searchData.wind_speed' => 'required|numeric',
            'searchData.humidity' => 'required|integer',
            'searchData.precip' => 'required|numeric',
        ]);
        // Cria a busca pela service
        $search = $this->searchService->createSearch($validated['searchData'], $user->id);
        return response()->json(['message' => 'Busca Salva em Minhas Buscas, Confira no menu superior!', 'search' => $search]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Captura de erros de validação
        return response()->json(['error' => 'Ocorreu um erro interno ao validar os dados repassados, tente mais tarde..', 'messages' => $e->validator->errors()], 422);
    } catch (\Exception $e) {
        // Captura de outros erros
        return response()->json(['error' => 'Ocorreu um erro ao tentar Salvar o registro, tente mais tarde', 'message' => $e->getMessage()], 500);
    }
}


    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para ver suas buscas.');
        }
        // Usa a service para obter as buscas do usuário
        $searches = $this->searchService->getUserSearches($user->id);
        return view('mysearches', compact('searches'));
    }

    public function delete(Request $request)
    {
        $searchId = $request->id;
        // Chama o serviço para deletar a busca
        $deleted = $this->searchService->deleteSearch($searchId);
        if ($deleted) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
