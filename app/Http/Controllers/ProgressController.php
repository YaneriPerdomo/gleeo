<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\Progress;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProgressController extends Controller
{
    public function player(Request $request, $slugCurrentLevel)
    {
        $playerID = $request->session()->get('player_id');

        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();
        $LevelAssignedPlayer = Level::where('slug', $slugCurrentLevel)->first();
        $levelID = $LevelAssignedPlayer->level_id;
        $totalNumberLessonsCompleted = PlayerLesson::whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
            return $query->where('level_id',  $levelID);
        })->where('player_id', $playerID)->where('state', 'Completada')->count();

        $totalNumberLessons = PlayerLesson::whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
            return $query->where('level_id',  $levelID);
        })->where('player_id', $playerID)->count();
        $progress = Progress::where('level_id', $LevelAssignedPlayer->level_id)->first();

        $AVGSuccessRate =  PlayerLesson::whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
            return $query->where('level_id',  $levelID);
        })->where('player_id', $playerID)->avg('success_rate');

        $totalDiamonds = Progress::where('level_id', $levelID)->where('player_id', $playerID)->first();

        $mistakesMade = PlayerLesson::whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
            return $query->where('level_id',  $levelID);
        })->where('player_id', $playerID)->sum('total_number_incorrect');

        $pointsObtained = PlayerLesson::whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
            return $query->where('level_id',  $levelID);
        })->where('player_id', $playerID)->sum('total_number_correct');

        $level = Level::where('slug', $slugCurrentLevel)->first();

        $totalErrorsTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'topics.title',
                FacadesDB::raw('SUM(player_lessons.total_number_incorrect) AS value')
            )
            ->where('levels.level_id', $levelID)
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('topics.title')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        $totalPointsObtainedTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'topics.title',
                FacadesDB::raw('SUM(player_lessons.total_number_correct) AS value')
            )
            ->where('levels.level_id', $levelID)
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('topics.title')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        return view('authenticated.educational-platform.progress', [
            'player'         => $player,
            'theme'          => $player->theme,
            'progress' => $progress,
            'totalNumberLessonsCompleted' => $totalNumberLessonsCompleted,
            'totalNumberLessons' => $totalNumberLessons,
            'AVGSuccessRate' => round($AVGSuccessRate),
            'totalDiamonds' => $totalDiamonds->diamonds,
            'mistakesMade' => $mistakesMade,
            'pointsObtained' => $pointsObtained,
            'totalErrorsTopic' => $totalErrorsTopic,
            'totalPointsObtainedTopic' => $totalPointsObtainedTopic
        ]);
    }
}
