<?php

namespace App\Http\Controllers;

use App\Models\AlertThreshold;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\Practice;
use App\Models\Progress;
use App\Models\ReinforcementFailureLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function gamingExperience(Request $request, $level, $module, $topic, $lesson)
    {
        $lesson = Lesson::where('slug', $lesson)->first();

        $reinforcementFailureLimit =  ReinforcementFailureLimit::first();


        $playerID = $request->session()->get('player_id');

        $player = Player::with(['avatar', 'theme'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $lessonExercises = Practice::where('lesson_id', $lesson->lesson_id)
            ->with(['practiceOption' => function ($query) {
                return $query;
            }])
            ->with(['reinforcement' => function ($query) {
                return $query;
            }])
            ->get();

        $alertThreshold = AlertThreshold::select('refuerzo_fail_limit', 'decision_pattern_id')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Activación del Contenido de Esfuerzo');
            })->with(['decision_pattern' => function ($query) {
                return $query->select('name', 'decision_pattern_id', 'is_active');
            }])
            ->first();

        $totalExercises = $lessonExercises->count();
        return view(
            'authenticated.educational-platform.gaming-experience',
            [
                'theme'          => $player->theme,
                'player'         => $player,
                'lessonExercises' => $lessonExercises,
                'lesson' => $lesson,
                'totalExercises' => $totalExercises,
                'refuerzoFailLimit' => $alertThreshold->refuerzo_fail_limit,
                'reinforcementFailureLimit' => $reinforcementFailureLimit

            ]
        );
    }

    public function endLesson(Request $request, $lessonID, $playerID)
    {
        if (intval($playerID) !== intval(Auth::user()->player->player_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lo sentimos, no tienes permiso para acceder a los datos de otro jugador.'
            ], 403);
        }

        $lessonPlayerInfo = PlayerLesson::with('lesson.topic.module')
            ->where('lesson_id', $lessonID)
            ->where('player_id', $playerID)
            ->firstOrFail();

        $levelID = $lessonPlayerInfo->lesson->topic->module->level_id;
        if ($lessonPlayerInfo->state === 'Completada') {
            Progress::where('level_id', $levelID)
                ->where('player_id', $playerID)
                ->increment('diamonds', intval($request->reward_diamonds));
            return response()->json(['message' => 'Lección ya completada anteriormente'], 200);
        }

        $totalLecciones = Lesson::whereHas('topic.module', function ($query) use ($levelID) {
            $query->where('level_id', $levelID);
        })->count();

        $progressLevelPlayer = Progress::where('level_id', $levelID)
            ->where('player_id', $playerID)->first();
        $incrementoProgreso = $totalLecciones > 0  ? (100 / $totalLecciones) : 0;

        if ($progressLevelPlayer->percentage_bar < 100) {
            Progress::where('level_id', $levelID)
                ->where('player_id', $playerID)
                ->update([
                    'percentage_bar' => DB::raw("LEAST(percentage_bar + $incrementoProgreso, 100)"),
                    'diamonds' => DB::raw("diamonds + " . intval($request->reward_diamonds))
                ]);
        }

        $lessonPlayerInfo->update([
            'state' => 'Completada',
            'reward_diamonds' => $request->reward_diamonds || 0,
            'estimated_time' => $request->estimated_time || NULL,
            'motivational_message' => $request->motivational_message || 'AY NO...',
            'success_rate' => $request->success_rate,
            'total_number_incorrect' => $request->total_number_incorrect,
            'total_number_correct' => $request->total_number_correct
        ]);

        return response()->json(['status' => 'success'], 200);
    }
    public function profile() {}
}
