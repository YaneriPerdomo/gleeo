<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\Module;
use App\Models\Practice;
use App\Models\practiceOption;
use App\Models\Reinforcement;
use App\Models\Topic;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDOException;

class LessonController extends Controller
{
    public function index()
    {
        return 'hola';
    }

    public function create($slugLevel, $slugTopic)
    {
        if (!Topic::where('slug', $slugTopic)->exists()) {
            return 'El tema no existe para que pueda agregar una nueva leccion, por favor selccione otro tema por lo cual me despido!!!';
        }



        $moduloTopicInfo = Module::select('module_id',  'title', 'slug')->whereHas('topic', function ($query) use ($slugTopic) {
            $query->select('slug', 'topic_id', 'module_id')->where('slug', $slugTopic);
        })->with(['topic' => function ($query) {
            $query->select('slug', 'topic_id', 'title', 'module_id');
        }])->first();



        return view(
            'authenticated.administrator.study-plan.level.lesson.create',
            [
                'slugLevel' => $slugLevel,
                'slugTopic' => $slugTopic,
                'moduloTopicInfo' => $moduloTopicInfo
            ]
        );
    }

    public function store(Request $request, $slugLevel, $slugTopic)
    {

        $requestPraticeData = $request->except([
            '_method',
            '_token',
            'leccion_activa',
            'guia_parrafo',
            'leccion_titulo',
        ]);
        $topic = Topic::where('slug', $slugTopic)->first();
        $topicId = $topic->topic_id;
        $numberOfItems = count($requestPraticeData) / 8;
        try {
            DB::beginTransaction();
            $level = Level::where('slug', $slugLevel)->first();
            $levelID = $level->level_id;
            $allLessons = Lesson::whereHas('topic.module.level', function ($query) use ($levelID){
                return $query->where('level_id', $levelID);
            })->count();

            $lesson = new Lesson();
            $lesson->order = $allLessons + 1;
            $lesson->topic_id = $topicId;
            $lesson->title = $request['leccion_titulo'];
            $lesson->guide = $request['guia_parrafo'];
            $lesson->slug = Str::slug($request->leccion_titulo);
            $lesson->is_active = 1;
            $lesson->save();
            for ($i = 1; $i <= $numberOfItems; $i++) {
                $tipoPregunta = $requestPraticeData['tipoPregunta_' . $i] ?? null;
                $tituloPractica = $requestPraticeData['tituloPractica_' . $i] ?? null;
                $variables = $requestPraticeData['variables_' . $i] ?? null;
                $variableCorrecta = $requestPraticeData['variableCorrecta_' . $i] ?? null;
                $refuerzoUrl = $requestPraticeData['refuerzoUrl_' . $i] ?? null;
                $refuerzoTitulo = $requestPraticeData['refuerzoTitulo_' . $i] ?? null;
                $refuerzoParrafo = $requestPraticeData['refuerzoParrafo_' . $i] ?? null;
                $practicaPantalla = $requestPraticeData['practicaPantalla_' . $i] ?? null;

                //Añadiendo las variables al igual la correcta a la tabla de opciones que se relaciona con la tabla padre llamada practicas
                $practiceOptiones = new practiceOption();
                $practiceOptiones->variables = $variables;
                $practiceOptiones->correct_variable = $variableCorrecta;
                $practiceOptiones->save();

                $reinforcement = new Reinforcement;
                $reinforcement->title = $refuerzoTitulo;
                $reinforcement->paragraph = $refuerzoParrafo;
                $reinforcement->url = str_replace('"', "'", $refuerzoUrl);
                $reinforcement->img = null;
                $reinforcement->save();

                $practice = new Practice();
                $practice->number = $i;
                $practice->lesson_id = $lesson->lesson_id;
                $practice->title = $tituloPractica;
                $practice->reinforcement_id = $reinforcement->reinforcement_id;
                $practice->practice_option_id = $practiceOptiones->practice_option_id;
                $practice->type_dynamic = $tipoPregunta;
                $practice->screen = $practicaPantalla;
                $practice->save();
            }


            DB::commit();
            $lessonTitle = $lesson->title;
            $topicTitle  = $topic->title;
            $moduleTitle = $topic->module->title;
            $mensaje = "¡Lección creada! En el módulo '{$moduleTitle}', tema '{$topicTitle}', ";
            $mensaje .= "se ha guardado la lección '{$lessonTitle}' con {$numberOfItems} prácticas y sus refuerzos.";
            $request->session()->flash('alert-success', $mensaje);
            return redirect()->route('study-plan.level-index', ['nivel' => $slugLevel]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            DB::rollBack();
            return redirect()->route('lesson.create', ['nivel' => $slugLevel, 'topic_slug' => $slugTopic]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            DB::rollBack();
            return redirect()->route('lesson.create', ['nivel' => $slugLevel, 'topic_slug' => $slugTopic]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            DB::rollBack();
            return redirect()->route('lesson.create', ['nivel' => $slugLevel, 'topic_slug' => $slugTopic]);
        }
    }



}
