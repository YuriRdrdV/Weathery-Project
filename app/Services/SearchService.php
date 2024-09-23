<?php
namespace App\Services;

use App\Models\Search;
use Illuminate\Support\Facades\Auth;

class SearchService
{
    public function createSearch(array $data, int $userId)
    {
        $search = new Search();
        $data['user_id'] = $userId;
        $search->user_id = $userId;
        $search->name = $data['name'];
        $search->country = $data['country'];
        $search->region = $data['region'];
        $search->localtime = $data['localtime'];
        $search->temperature = $data['temperature'];
        $search->feelslike = $data['feelslike'];
        $search->weather = $data['weather'];
        $search->icon = $data['icon'];
        $search->wind_speed = $data['wind_speed'];
        $search->humidity = $data['humidity'];
        $search->precip = $data['precip'];
        $search->save();
        return $search;
    }

    public function getUserSearches(int $userId)
    {
        return Search::where('user_id', $userId)->get();
    }

    public function deleteSearch($id)
    {
        $user = Auth::user();
        $search = $user->searches()->find($id);
        if ($search) {
            $search->delete();
            return response()->json(['message' => 'Search deletada com sucesso.'], 200);
        }
        return response()->json(['error' => 'Search não encontrada, ou de acesso restrito.'], 403);
    }
}
