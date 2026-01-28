<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\Progress;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function general(Request $request, $slugPlayer = '')
    {
        if (Auth::user()->rol_id == 3) {
            $playerID = $request->session()->get('player_id');
            $player = Player::with(['theme', 'level_assigned'])
                ->where('player_id', $playerID)
                ->firstOrFail();
        } else {
            $player = Player::where('slug', $slugPlayer)->first();
            $playerID = $player->player_id;
        }



        $totalProgress = Progress::where('player_id', $playerID)->count();
        $sumProgress = Progress::where('player_id', $playerID)->sum('percentage_bar');
        $percentage_bar =  $sumProgress / $totalProgress;


        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $totalNumberLessonsCompleted = PlayerLesson::where('player_id', $playerID)->where('state', 'Completada')->count();

        $totalNumberLessons = PlayerLesson::where('player_id', $playerID)->count();


        $AVGSuccessRate =  PlayerLesson::where('player_id', $playerID)->avg('success_rate');

        $totalDiamonds = Progress::where('player_id', $playerID)->first();

        $mistakesMade = PlayerLesson::where('player_id', $playerID)->sum('total_number_incorrect');

        $pointsObtained = PlayerLesson::where('player_id', $playerID)->sum('total_number_correct');


        $totalErrorsTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'levels.name AS level_title',
                'topics.title AS topic_title',
                'modules.title AS module_title',
                FacadesDB::raw('SUM(player_lessons.total_number_incorrect) AS value')
            )
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('modules.title', 'topics.title', 'levels.name')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        $totalPointsObtainedTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'levels.name AS level_title',
                'topics.title AS topic_title',
                'modules.title AS module_title',
                FacadesDB::raw('SUM(player_lessons.total_number_correct) AS value')
            )
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('modules.title', 'topics.title', 'levels.name')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        $levelStats = FacadesDB::table('progress')
            ->join('levels', 'progress.level_id', '=', 'levels.level_id')
            ->where('progress.player_id', $playerID)
            ->where('progress.state', 'Completado')
            ->select(
                FacadesDB::raw('MAX(levels.number) as max_level'),
                FacadesDB::raw('MIN(levels.number) as min_level')
            )
            ->limit(2)
            ->get();


        $max = $levelStats[0]->max_level;
        $min = $levelStats[0]->min_level;
        $view = match (Auth::user()->rol_id) {
            3 => 'authenticated.educational-platform.general-progress',
            2 => 'authenticated.adult.account.children.progress',
        };

        $data = [
            'player'         => $player,
            'percentage_bar' => $percentage_bar,
            'totalNumberLessonsCompleted' => $totalNumberLessonsCompleted,
            'totalNumberLessons' => $totalNumberLessons,
            'AVGSuccessRate' => round($AVGSuccessRate),
            'totalDiamonds' => $totalDiamonds->diamonds,
            'mistakesMade' => $mistakesMade,
            'pointsObtained' => $pointsObtained,
            'totalErrorsTopic' => $totalErrorsTopic,
            'max' => $max,
            'min' => $min,
            'totalPointsObtainedTopic' => $totalPointsObtainedTopic
        ];

        if (Auth::user()->rol_id == 3) {
            $data['theme'] = $player->theme;
        }
        return view($view, $data);
    }

    public function reportPDF(Request $request, $slugPlayer = '')
    {
        $player = Player::where('slug', $slugPlayer)->first();

        if (! $player) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $playerID = $player->player_id;

        $totalProgress = Progress::where('player_id', $playerID)->count();
        $sumProgress = Progress::where('player_id', $playerID)->sum('percentage_bar');
        $percentage_bar =  $sumProgress / $totalProgress;


        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $totalNumberLessonsCompleted = PlayerLesson::where('player_id', $playerID)->where('state', 'Completada')->count();

        $totalNumberLessons = PlayerLesson::where('player_id', $playerID)->count();


        $AVGSuccessRate =  PlayerLesson::where('player_id', $playerID)->avg('success_rate');

        $totalDiamonds = Progress::where('player_id', $playerID)->first();

        $mistakesMade = PlayerLesson::where('player_id', $playerID)->sum('total_number_incorrect');

        $pointsObtained = PlayerLesson::where('player_id', $playerID)->sum('total_number_correct');


        $totalErrorsTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'levels.name AS level_title',
                'topics.title AS topic_title',
                'modules.title AS module_title',
                FacadesDB::raw('SUM(player_lessons.total_number_incorrect) AS value')
            )
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('modules.title', 'topics.title', 'levels.name')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        $totalPointsObtainedTopic = FacadesDB::table('player_lessons')
            ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id')
            ->join('topics', 'lessons.topic_id', '=', 'topics.topic_id')
            ->join('modules', 'topics.module_id', '=', 'modules.module_id')
            ->join('levels', 'modules.level_id', '=', 'levels.level_id')
            ->select(
                'levels.name AS level_title',
                'topics.title AS topic_title',
                'modules.title AS module_title',
                FacadesDB::raw('SUM(player_lessons.total_number_correct) AS value')
            )
            ->where('player_lessons.player_id', $playerID)
            ->groupBy('modules.title', 'topics.title', 'levels.name')
            ->having('value', '!=', '0')
            ->orderBy('value', 'ASC')
            ->limit(5)->get();

        $levelStats = FacadesDB::table('progress')
            ->join('levels', 'progress.level_id', '=', 'levels.level_id')
            ->where('progress.player_id', $playerID)
            ->where('progress.state', 'Completado')
            ->select(
                FacadesDB::raw('MAX(levels.number) as max_level'),
                FacadesDB::raw('MIN(levels.number) as min_level')
            )
            ->limit(2)
            ->get();


        $max = $levelStats[0]->max_level;
        $min = $levelStats[0]->min_level;
        $view = match (Auth::user()->rol_id) {
            3 => 'authenticated.educational-platform.general-progress',
            2 => 'authenticated.adult.account.children.progress',
        };

        $data = [
            'player'         => $player,
            'percentage_bar' => $percentage_bar,
            'totalNumberLessonsCompleted' => $totalNumberLessonsCompleted,
            'totalNumberLessons' => $totalNumberLessons,
            'AVGSuccessRate' => round($AVGSuccessRate),
            'totalDiamonds' => $totalDiamonds->diamonds,
            'mistakesMade' => $mistakesMade,
            'pointsObtained' => $pointsObtained,
            'totalErrorsTopic' => $totalErrorsTopic,
            'max' => $max,
            'min' => $min,
            'totalPointsObtainedTopic' => $totalPointsObtainedTopic
        ];
        $pdf = Pdf::loadView(
            'authenticated.adult.account.children.reportPDF',
            $data
        );

        return $pdf->download($player->names . ' ' . $player->surnames .' - Progreso General del usuario '. $player->user->user.' - '  . date('d-m-Y') . '.pdf');
    }
}
