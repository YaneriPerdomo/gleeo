<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Player;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function player(Request $request, $slugCurrentLevel)
    {
        $playerID = $request->session()->get('player_id');

        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();
        $LevelAssignedPlayer = Level::where('slug', $slugCurrentLevel)->first();

        $progress = Progress::where('level_id', $LevelAssignedPlayer->level_id)->first();

        return view('authenticated.educational-platform.progress', [
            'player'         => $player,
            'theme'          => $player->theme,

        ]);
    }
}
