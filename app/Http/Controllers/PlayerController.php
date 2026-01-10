<?php

namespace App\Http\Controllers;

use App\Models\AlertThreshold;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Player;
use App\Models\Practice;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function gamingExperience(Request $request, $level, $module, $topic, $lesson)
    {
        $lesson = Lesson::where('slug', $lesson)->first();



        $playerID = $request->session()->get('player_id');

        $player = Player::with(['avatar', 'theme'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $lessonExercises = Practice::where('lesson_id', $lesson->lesson_id)
        ->with(['practiceOption' => function($query){
            return $query;
        }])
        ->with(['reinforcement' => function($query){
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
                'refuerzoFailLimit' => $alertThreshold->refuerzo_fail_limit

            ]
        );
    }

    public function profile(){

    }
}
