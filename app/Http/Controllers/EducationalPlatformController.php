<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\Module;
use App\Models\NewsBoard;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\PlayerLessons;
use App\Models\Progress;
use App\Models\Theme;
use Illuminate\Http\Request;

use function Symfony\Component\Translation\t;

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
            'player'         => $player,
            'theme'          => $player->theme,

        ]);
    }

    public function index(Request $request, $slugCurrentLevel)
    {

        $playerID = $request->session()->get('player_id');

        // 1. Obtenemos el nivel actual con sus módulos, temas y lecciones de un solo golpe (Eager Loading)
        $currentLevel = Level::where('slug', $slugCurrentLevel)
            ->with(['module.topics.lessons'])
            ->firstOrFail(); // Usa firstOrFail para manejar errores 404 automáticamente


        // 2. Módulos paginados (usando la relación del objeto ya cargado)
        $CurrentModules = $currentLevel->module()->paginate(5);

        // 3. Obtener el jugador con sus relaciones necesarias (Avatar y Tema)
        $player = Player::with(['avatar', 'theme'])
            ->where('player_id', $playerID)
            ->firstOrFail();

        // 4. Niveles con progreso del jugador (simplificado)
        $levels = Level::whereHas('progress', fn($q) => $q->where('player_id', $playerID))
            ->with(['progress' => fn($q) => $q->where('player_id', $playerID)])
            ->get();

        // 5. Ranking de diamantes (Top 5)
        $bestRanking = Progress::where('level_id', $currentLevel->level_id)
            ->with('player.avatar')
            ->orderByDesc('diamonds')
            ->limit(5)
            ->get();

        $levelID = $currentLevel->level_id;
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
                    'state' => 'Bloqueada'
                ]
            );
        }


        // 1. Verificamos si ya hay alguna lección activa
        $hasActive = PlayerLesson::where('player_id', $playerID)
            ->where('state', 'En Espera')
            ->exists();

        if (!$hasActive) {
            // 2. Buscamos SOLO la primera lección bloqueada de ese nivel
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


        return view('authenticated.educational-platform.index', [
            'currentLevel'   => $currentLevel,
            'CurrentModules' => $CurrentModules,
            'levels'         => $levels,
            'player'         => $player,
            'theme'          => $player->theme,
            'bestRanking'    => $bestRanking,
            'slugCurrentLevel' => $slugCurrentLevel
        ]);
    }

    public function currentLevelUpdate(Request $request, $levelId)
    {
        $playerID = $request->session()->get('player_id');
        $player = Player::where('player_id', $playerID)->first();
        if (!$player) {
            return response()->json(['status' => 'error', 'message' => 'No autorizado'], 401);
        }
        $player->current_level_id = $levelId;
        $player->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
