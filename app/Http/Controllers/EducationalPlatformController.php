<?php

namespace App\Http\Controllers;

use App\Models\AlertConfiguration;
use App\Models\InterventionNotification;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\NewsBoard;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\PlayerLessonHistory;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Log;

class EducationalPlatformController extends Controller
{
    public function welcome(Request $request)
    {

        $playerID = $request->session()->get('player_id');

        $player = Player::with(['theme', 'level_assigned'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        $data = NewsBoard::select('subject', 'news_board_id', 'description')->where('news_board_id', 1)->first();

        return view('authenticated.educational-platform.welcome', [
            'data' => $data,
            'player' => $player,
            'theme' => $player->theme,
        ]);
    }

    public function index(Request $request, $slugCurrentLevel)
    {
        $playerID = $request->session()->get('player_id');

        $level = Level::with(['moduleOne' => function ($query) {
            return $query;
        }])
            ->where('slug', $slugCurrentLevel)
            ->firstOrFail();


        $levelID = $level->level_id;



        // 3. Obtener el jugador con sus relaciones necesarias (Avatar y Tema)
        $player = Player::with(['avatar', 'theme'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        // 4. Niveles con progreso del jugador (simplificado)
        $levels = Level::whereHas('progress', fn($q) => $q->where('player_id', $playerID))
            ->with(['progress' => fn($q) => $q->where('player_id', $playerID)])
            ->get();

        // 5. Ranking de diamantes (Top 5)
        $bestRanking = Progress::where('level_id', $levelID)
            ->with('player.avatar')
            ->orderByDesc('diamonds')
            ->limit(5)
            ->get();

        $allLessons = Lesson::whereHas('topic.module.level', function ($q) use ($levelID) {
            return $q->where('level_id', $levelID);
        })->get();

        foreach ($allLessons as $key => $value) {
            PlayerLesson::firstOrCreate(
                [
                    'lesson_id' => $value->lesson_id,
                    'player_id' => $playerID,
                ],
                [
                    'state' => 'Bloqueada',
                ]
            );
        }

        $hasActive = PlayerLesson::where('player_id', $playerID)
            ->where('state', 'En Espera')
            ->exists();
        if (! $hasActive) {
            //  Buscamos SOLO la primera lección bloqueada de ese nivel
            $nextLesson = PlayerLesson::where('player_id', $playerID)
                ->where('state', 'Bloqueada')
                ->whereHas('lesson.topic.module.level', function ($query) use ($levelID) {
                    $query->where('level_id', $levelID);
                })
                ->join('lessons', 'player_lessons.lesson_id', '=', 'lessons.lesson_id') // Unimos para poder ordenar
                ->orderBy('lessons.order', 'asc') // Ordenamos por la columna de la tabla unida
                ->select('player_lessons.*') // Evitamos colisión de IDs seleccionando solo los datos de la relación
                ->first();
            if ($nextLesson) {
                $nextLesson->update(['state' => 'En Espera']);
            }
        }

        $lessonsQuery = PlayerLesson::where('player_id', $playerID)
            ->whereHas('lesson.topic.module', function ($query) use ($levelID) {
                $query->where('level_id', $levelID);
            });

        $countTotal = (clone $lessonsQuery)->count();
        $countCompleted = (clone $lessonsQuery)->where('state', 'Completada')->count();

        $levelUnlocked = ['state' => false, 'levelSlug' => null];

        $progress = Progress::where('player_id', $playerID)->where('level_id', $levelID)->first();

        if ($countTotal > 0 && $countTotal === $countCompleted) {

            // Obtenemos el número del nivel actual para buscar el siguiente
            $currentLevel = Level::find($levelID);
            $nextLevelNumber = intval($currentLevel->number) + 1;

            // 5. Buscamos si existe el siguiente nivel bloqueado para este jugador
            $nextProgress = Progress::where('player_id', $playerID)
                ->where('state', 'Bloqueado')
                ->whereHas('level', function ($query) use ($nextLevelNumber) {
                    $query->where('number', $nextLevelNumber);
                })
                ->first();

            if ($nextProgress) {
                try {
                    // 6. Usamos una transacción para asegurar que no haya datos huérfanos
                    FacadesDB::transaction(function () use ($nextProgress, $player) {
                        // Actualizamos el estado del progreso del siguiente nivel
                        $nextProgress->update([
                            'state' => 'En Progreso',
                        ]);

                        // Actualizamos el puntero del jugador al nuevo nivel
                        $player->update([
                            'level_assigned_id' => $nextProgress->level_id,
                            'current_level_id' => $nextProgress->level_id,
                        ]);
                    });

                    $levelUnlocked = [
                        'state' => true,
                        'levelSlug' => $nextProgress->level->slug,
                    ];
                } catch (\Exception $e) {
                    Log::error('Error al desbloquear nivel: ' . $e->getMessage());

                    return response()->json(['error' => 'No se pudo actualizar el progreso'], 500);
                }
            } else {
            }
        } else {
            $actualPercentage = ($countTotal > 0) ? (100 / $countTotal) : 0;
            $hasNewContent = ($progress && $progress->percentage_bar == 100.00 && $countTotal != $countCompleted);
            if ($hasNewContent) {
                $progress->percentage_bar = number_format($actualPercentage, 2);
                $progress->state = 'En Progreso';
                $progress->save();
            }
        }

        $currentLevel = Level::where('slug', $slugCurrentLevel)->firstOrFail();

        $currentModules = $currentLevel->module()
            ->with(['topics.lessons.playerProgress' => function ($query) use ($playerID) {
                $query->where('player_id', $playerID);
            }])
            ->paginate(5);

        $currentLevel->setRelation('module', $currentModules);

        return view('authenticated.educational-platform.index', [
            'currentLevel' => $currentLevel,
            'CurrentModules' => $currentModules,
            'levels' => $levels,
            'player' => $player,
            'theme' => $player->theme,
            'bestRanking' => $bestRanking,
            'levelUnlocked' => $levelUnlocked,
            'slugCurrentLevel' => $slugCurrentLevel,
            'progress' => $progress,
        ]);
    }

    public function currentLevelUpdate(Request $request, $levelId)
    {
        $playerID = $request->session()->get('player_id');
        $player = Player::where('player_id', $playerID)->first();
        if (! $player) {
            return response()->json(['status' => 'error', 'message' => 'No autorizado'], 401);
        }
        $player->current_level_id = $levelId;
        $player->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
