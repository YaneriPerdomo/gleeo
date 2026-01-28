<?php

namespace App\Http\Controllers;

use App\Models\AlertConfiguration;
use App\Models\AlertThreshold;
use App\Models\InterventionNotification;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Player;
use App\Models\PlayerLesson;
use App\Models\PlayerLessonHistory;
use App\Models\Practice;
use App\Models\Progress;
use App\Models\ReinforcementFailureLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use PDOException;

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
        $playerLessonInfo = PlayerLesson::where('lesson_id', $lesson->lesson_id)->where('player_id', $playerID)->first();

        return view(
            'authenticated.educational-platform.gaming-experience',
            [
                'theme'          => $player->theme,
                'player'         => $player,
                'lessonExercises' => $lessonExercises,
                'lesson' => $lesson,
                'totalExercises' => $totalExercises,
                'refuerzoFailLimit' => $alertThreshold->refuerzo_fail_limit,
                'reinforcementFailureLimit' => $reinforcementFailureLimit,
                'playerLessonInfo' => $playerLessonInfo

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
        try {
            FacadesDB::beginTransaction();
            $lessonPlayerAddHistory = new PlayerLessonHistory();
            $lessonPlayerAddHistory->player_id = $playerID;
            $lessonPlayerAddHistory->lesson_id = $lessonID;
            $lessonPlayerAddHistory->estimated_time = $request->estimated_time;
            $lessonPlayerAddHistory->success_rate = $request->success_rate;
            $lessonPlayerAddHistory->reward_diamonds = $request->reward_diamonds;
            $lessonPlayerAddHistory->status = $request->reward_diamonds == 0 ? 'Fallida' : 'Completada';
            $lessonPlayerAddHistory->number_incorrect = $request->total_number_incorrect || 0;
            $lessonPlayerAddHistory->number_correct = $request->total_number_correct || 0;
            $lessonPlayerAddHistory->en_uso = 0;
            $lessonPlayerAddHistory->save();

            $lessonPlayerInfo = PlayerLesson::with('lesson.topic.module')
                ->where('lesson_id', $lessonID)
                ->where('player_id', $playerID)
                ->firstOrFail();
            $lessonPlayerInfo->total_number_correct = /*$lessonPlayerInfo->total_number_correct + */ $request->total_number_correct || 0;
            $lessonPlayerInfo->total_number_incorrect = /*$lessonPlayerInfo->total_number_incorrect +*/ $request->total_number_incorrect || 0;
            $lessonPlayerInfo->estimated_time = $request->estimated_time;
            $lessonPlayerInfo->reward_diamonds = $request->reward_diamonds;
            $lessonPlayerInfo->success_rate = $request->success_rate;
            $lessonPlayerInfo->save();

            $levelID = $lessonPlayerInfo->lesson->topic->module->level_id;
            $lesson = Lesson::with(['topic'])->where('lesson_id', $lessonID)->first();
            /*Inicio*/

            $level = Level::where('level_id', $levelID)->first();

            $alertConfig = AlertConfiguration::where('level_id', $levelID)->first();

            if ($alertConfig && $alertConfig->time_frame !== 'N/A') {

                $timeFrameValue = (int) filter_var($alertConfig->time_frame, FILTER_SANITIZE_NUMBER_INT);
                $maxErrors = (int) $alertConfig->max_errors_allowed;

                $startDate = str_contains($alertConfig->time_frame, 'Horas')
                    ? now()->subHours($timeFrameValue)
                    : now()->subDays($timeFrameValue);

                $totalErrors = PlayerLessonHistory::where('player_id', $playerID)
                    ->where('lesson_id', $lessonID)
                    ->where('en_uso', 0)
                    ->where('created_at', '>=', $startDate)
                    ->sum('number_incorrect');

                if ($totalErrors >= $maxErrors) {
                    // 2. Acceso seguro: Solo usamos module y el nombre del nivel (lección)
                    $modulo = $level->module[0]->name ?? 'Sin Módulo';
                    $nivel = $level->name ?? 'Nivel Actual';
                    $tema = $lesson->topic->name;
                    $player = Player::find($playerID);
                    $representativeID = $player->representative_id ?? null;
                    $playerName = $player->names . ' ' . $player->surnames;
                    $distinctLessonsCount = PlayerLessonHistory::where('player_id', $playerID)
                        ->where('en_uso', 0)
                        ->where('created_at', '>=', $startDate)
                        ->where('lesson_id', $lessonID)
                        ->distinct('lesson_id')
                        ->count('lesson_id');

                    $genero = $player->gender_id == 1 ? 'del Jugador' : 'de la Jugadora';
                    // 3. Notificación (Quitamos el Tema de la razón ya que no existe la relación)
                    InterventionNotification::create([
                        'player_id' => $playerID,
                        'representative_id' => $representativeID,
                        'reason' => "$playerName ha superado el límite de errores en los últimos $alertConfig->time_frame. Dificultad detectada en el Nivel: Nivel: $nivel | Módulo: $modulo | Tema: $tema | Leccion: $lesson->title.  ",
                        'total_errors_detected' => $totalErrors,
                        'distinct_lessons_failed' => $distinctLessonsCount,
                        'is_read' => 0,
                    ]);

                    PlayerLessonHistory::where('player_id', $playerID)
                        ->where('en_uso', 0)
                        ->where('created_at', '>=', $startDate)
                        ->update(['en_uso' => 1]);
                }
            }



            /*Fin*/
            Progress::where('level_id', $levelID)
                ->where('player_id', $playerID)
                ->increment('diamonds', intval($request->reward_diamonds));
            if ($lessonPlayerInfo->state === 'Completada') {
                FacadesDB::commit();

                return response()->json(['message' => 'Lección ya completada anteriormente'], 200);
            }

            $totalLecciones = Lesson::whereHas('topic.module', function ($query) use ($levelID) {
                $query->where('level_id', $levelID);
            })->count();

            $progressLevelPlayer = Progress::where('level_id', $levelID)
                ->where('player_id', $playerID)->first();
            $incrementoProgreso = $totalLecciones > 0  ? (100 / $totalLecciones) : 0;

            $progress = Progress::where('level_id', $levelID)
                ->where('player_id', $playerID)
                ->first();

            if ($progress && $progress->percentage_bar < 100) {
                $nuevoPorcentaje = min($progress->percentage_bar + $incrementoProgreso, 100);
                $progress->percentage_bar = $nuevoPorcentaje;
                $progress->diamonds += intval($request->reward_diamonds);
                if ($nuevoPorcentaje >= 100) {
                    $progress->state = 'Completado';
                }
                $progress->save();
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
            FacadesDB::commit();
            return response()->json(['status' => 'success'], 200);
        } catch (QueryException $ex) {
            FacadesDB::rollBack();
            return response()->json(['status' => $ex->getMessage(), 500]);
        } catch (PDOException $ex) {
            FacadesDB::rollBack();
            return response()->json(['status' => $ex->getMessage(), 500]);
        } catch (Exception $ex) {
            FacadesDB::rollBack();
            return response()->json(['status' => $ex->getMessage(), 500]);
        }
    }
    public function profile() {}
}
