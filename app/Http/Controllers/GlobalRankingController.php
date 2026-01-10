<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Progress;
use Illuminate\Http\Request;

class GlobalRankingController extends Controller
{
    public function __invoke(Request $request)
    {
        $playerID = $request->session()->get('player_id');

        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $bestRanking = Progress::where('level_id', $player->current_level_id)
            ->with('player.avatar')
            ->orderByDesc('diamonds')
            ->limit(5)
            ->get();


        return view('authenticated.educational-platform.global-ranking', [
            'bestRanking' => $bestRanking,
            'player'         => $player,
            'theme'          => $player->theme,

        ]);
    }
}
