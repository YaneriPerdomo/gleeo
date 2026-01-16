<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class GlobalRankingController extends Controller
{
    public function byLevel(Request $request)
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

        $progress = Progress::where('player_id', $playerID)->where('level_id', $player->current_level_id)->first();

        return view('authenticated.educational-platform.general-ranking', [
            'bestRanking' => $bestRanking,
            'player'         => $player,
            'theme'          => $player->theme,
            'progress' => $progress
        ]);
    }

    public function global(Request $request)
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

        $progress = Progress::where('player_id', $playerID)->where('level_id', $player->current_level_id)->first();

             $levelStats = FacadesDB::table('progress')
            ->join('levels', 'progress.level_id', '=', 'levels.level_id')
            ->where('progress.player_id', $playerID)
            ->select(
                FacadesDB::raw('MAX(levels.number) as max_level'),
                FacadesDB::raw('MIN(levels.number) as min_level')
            )
            ->limit(2)
            ->get();


        $max = $levelStats[0]->max_level;
        $min = $levelStats[0]->min_level;
        return view('authenticated.educational-platform.global-ranking', [
            'bestRanking' => $bestRanking,
            'player'         => $player,
            'theme'          => $player->theme,
            'progress' => $progress,
            'max' => $max,
            'min' => $min
        ]);
    }
}
