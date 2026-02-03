<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Module;
use App\Models\Topic;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use PDOException;

class TopicController extends Controller
{
    public function create($slugLevel, $slugModule)
    {




        $infoLevel = Level::where('slug', $slugLevel)->first();

        return view(
            'authenticated.administrator.study-plan.level.topic.create',
            [
                'infoLevel' => $infoLevel,
                'slugLevel' => $slugLevel,
                'slugModule' => $slugModule,

            ]
        );
    }

    public function store(TopicStoreRequest $request, $slug_level, $slug_module)
    {

        $module = Module::select('module_id', 'slug', 'title')->where('slug', $slug_module)->first();

        if (! $module) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $string = $slug_level;

        $module_id = $module->module_id;
        try {
            FacadesDB::beginTransaction();

            $slug_topic = Str::slug($request->topic_title);

            Topic::create([
                'title' => $request->topic_title,
                'slug' => $slug_topic,
                'module_id' => $module_id,
            ]);

            FacadesDB::commit();

            $request->session()->flash('alert-success', "Se ha creado el tema '{$request->topic_title}' en el módulo '{$module->title}' con éxito.");

            return redirect()->route('study-plan.level-index', ['nivel' => $slug_level]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.create', ['nivel' => $slug_level, 'slug' => $slug_module]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.create', ['nivel' => $slug_level, 'slug' => $slug_module]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.create', ['nivel' => $slug_level, 'slug' => $slug_module]);
        }
    }

    public function edit($slugLevel, $slugTopic)
    {
        $levelInfo = Module::whereHas('topic', function ($query) use ($slugTopic) {
            return $query->where('slug', $slugTopic);
        })->with(['topic' => function ($query) use ($slugTopic) {
            return $query->where('slug', $slugTopic);
        }])->first();
        if (! $levelInfo) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        return view(
            'authenticated.administrator.study-plan.level.topic.edit',
            [
                'levelInfo' => $levelInfo,
                'slugLevel' => $slugLevel,
                'slugTopic' => $slugTopic
            ]
        );
    }

    public function update(TopicUpdateRequest $request, $level, $slug)
    {

        $topic = Topic::where('slug', $slug)->first();

        if (! $topic) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        if (
            Topic::where('title', $request->topic_title)
            ->whereNot('topic_id', $topic->module_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'topic_title' =>
                        'Este nombre del tema ya está registrado.'
                    ]
                );
        }
        try {
            FacadesDB::beginTransaction();

            $slug = Str::slug($request->topic_title);

            $topic->update([
                'title' => $request->topic_title,
                'slug' => $slug,
            ]);

            FacadesDB::commit();

            $request->session()->flash('alert-success', "El Tema '{$topic->title}' ha sido actualizado correctamente.");


            return redirect()->route('study-plan.level-index', ['nivel' => $level]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        }
    }

    public function delete($level, $slug)
    {
        $data = Topic::with(['module' => function ($query) {
                return $query;
            }])->where('slug',  $slug)->first();



        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $name = match ($level) {
            'nivel-1-basico' => 'Nivel Basico',
            '' => '',
            default => 'ERROR'
        };

        return view(
            'authenticated.administrator.study-plan.level.topic.delete',
            [
                'topic' => $data,
                'level' => [
                    [
                        'slug' => $level,
                        'name' => $name,
                    ],

                ],
                'slug' => $slug,
            ]
        );
    }

    public function destroy(Request $request, $level, $slug)
    {
        $topic = Topic::where('slug', $slug)->first();

        if (! $topic) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $name = match ($level) {
            'nivel-1-basico' => 'Nivel Basico',
            '' => '',
            default => 'ERROR'
        };

        $topic_id = $topic->topic_id;
        try {
            FacadesDB::beginTransaction();
            $countLessons = Lesson::where('topic_id', $topic_id)->count();
            $topicName = $topic->title;
            $topic->delete();
            FacadesDB::commit();
            $mensaje = "El tema '{$topicName}' ha sido eliminado correctamente. ";
            $mensaje .= "Se removieron {$countLessons} lecciones asociadas.";

            $request->session()->flash('alert-success', $mensaje);

            return redirect()->route('study-plan.level-index', ['nivel' => $level]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('topic.edit', ['nivel' => $level, 'slug' => $slug]);
        }
    }
}
