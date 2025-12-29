<?php

namespace App\Http\Controllers;

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

class StudyPlanController extends Controller
{
    public function index()
    {
        $levels = Level::with(['module' => function ($query) {
            return $query;
        }])
        ->where('deleted_at', '=' , 1)
        ->orderBy('number', 'ASC')->paginate(10);

        return view(
            'authenticated.administrator.study-plan.index',
            [
                'levels' => $levels,

            ]
        );
    }

    public function level($slug)
    {


        $levelModel = Level::where('slug', $slug)->first();
        $modules = Module::where('level_id', $levelModel->level_id)
            ->with(['topics' => function ($query) {
                return $query->with(['lessons' => function ($query) {}]);
            }])
            ->paginate(5);
        $test = 'nivel-1-basico';
        $array = explode('-', $test);
        $noSlug = '';


        return view(
            'authenticated.administrator.study-plan.level.index',
            [
                'modules' => $modules,
                'infoLevel' => [
                    'slug' => $slug,
                    'name' => $levelModel->name,
                ],
            ]
        );
    }

    public function create()
    {
        return view(
            'authenticated.administrator.study-plan.create',

        );
    }

    public function store(Request $request)
    {

        try {
            FacadesDB::beginTransaction();

            $countLessons = Level::whereIn('deleted_at', [null, 1])->count() ?? 0;

            $slug_level_title = Str::slug($request->level_title);
            $ultimoNivel = $countLessons + 1;
            $slug = 'nivel-' . $ultimoNivel . '-' . $slug_level_title;

            $level_new = new Level;
            $level_new->name = $request->level_title;
            $level_new->slug = $slug;
            $level_new->number = $ultimoNivel;
            $level_new->save();

            FacadesDB::commit();

            $request->session()->flash('alert-success', "¡Éxito! El nivel '{$request->level_title}' (N° {$ultimoNivel}) se ha agregado correctamente.");

            return redirect()->route('study-plan.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('study-plan.create');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('study-plan.create');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('study-plan.create');
        }
    }

    public function edit($slugLevel)
    {

        $levelInfo = Level::where('slug', $slugLevel)
            ->first();
        return view(
            'authenticated.administrator.study-plan.edit',
            [
                'slugLevel' => $slugLevel,
                'levelInfo' => $levelInfo,
            ]
        );
    }

    public function update(Request $request, $slugLevel)
    {
        $level = Level::where('slug', $slugLevel)->first();
        if (! $level) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        try {
            FacadesDB::beginTransaction();
            $slug_level_title = Str::slug($request->level_title);
            $slug = 'nivel-' . $level->number . '-' . $slug_level_title;
            $level->update([
                'name' => $request->level_title,
                'slug' => $slug,
            ]);
            FacadesDB::commit();
            $request->session()->flash('alert-success', "¡Éxito! El nivel '{$request->level_title}' (N° {$level->number}) se ha actualizado correctamente.");
            return redirect()->route('study-plan.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-edit', ['nivel' => $slugLevel]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-edit', ['nivel' => $slugLevel]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-edit', ['nivel' => $slugLevel]);
        }
    }

    public function delete($slugLevel)
    {
        $infoLevel = Level::where('slug', $slugLevel)
            ->first();


        if (! $infoLevel) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $level_id = $infoLevel->level_id;
        $count = [
            'modules' => Module::where('level_id', $level_id)->count(),
            'topics' =>  Topic::whereHas('module', function ($query) use ($level_id) {
                return $query->where('level_id', $level_id);
            })->count(),
        ];
        return view(
            'authenticated.administrator.study-plan.delete',
            [
                'infoLevel' => $infoLevel,
                'slugLevel' => $slugLevel,
                'count' => $count

            ]
        );
    }

    public function destroy(Request $request, $slugLevel)
    {
        $infoLevel = Level::where('slug', $slugLevel)->first();
        if (!$infoLevel) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $level_id = $infoLevel->level_id;
        $levelName = $infoLevel->name;
        $countModules = Module::where('level_id', $level_id)->count();
        $countTopics = Topic::whereHas('module', function ($query) use ($level_id) {
            $query->where('level_id', $level_id);
        })->count();
        $countLessons = Lesson::whereHas('topic.module', function ($query) use ($level_id) {
            $query->where('level_id', $level_id);
        })->count();
        try {
            FacadesDB::beginTransaction();
            $infoLevel->delete();
            $mensaje = "El nivel '{$levelName}' fue eliminado correctamente. ";
            $mensaje .= "Se removieron {$countModules} módulos, {$countTopics} temas y {$countLessons} lecciones asociadas.";
            FacadesDB::commit();
            return redirect()->route('study-plan.index')->with('alert-success', $mensaje);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-delete', ['nivel' => $slugLevel]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-delete', ['nivel' => $slugLevel]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('study-plan.level-delete', ['nivel' => $slugLevel]);
        }
    }

    public function filter($search)
    {
        $test = explode('[', $search);
        $search_l = str_replace(']', '', $test[1]);

        $levels = Level::with(['module' => function ($query) {
            return $query;
        }])
            ->where('name', 'LIKE', '%' . trim($search_l) . '%')
            ->orderBy('number', 'ASC')->paginate(10);

        return view(
            'authenticated.administrator.study-plan.index',
            [
                'levels' => $levels,
                'isRelativeURL' => '../',
                'isStateSearch' => false,
                'searchValue' => $search_l,
            ]
        );
    }
}
