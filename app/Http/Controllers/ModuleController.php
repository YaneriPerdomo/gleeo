<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleStoreRequest;
use App\Http\Requests\ModuleUpdateRequest;
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

class ModuleController extends Controller
{
    public function create($slug)
    {

        $level_ = Level::where('slug', $slug)->first();

        return view(
            'authenticated.administrator.study-plan.level.module.create',
            [
                    'infoLevel' => [
                    'slug' => $slug,
                    'name' => $level_->name,
                ],
            ]
        );
    }

    public function store(ModuleStoreRequest $request, $slug)
    {

        $level_ = Level::where('slug', $slug)->first();
        try {
            FacadesDB::beginTransaction();

            $slug_module = Str::slug($request->module_title);
            $newModule = Module::create([
                'title' => $request->module_title,
                'slug' => $slug_module,
                'level_id' => $level_->level_id,
            ]);

            FacadesDB::commit();

            $request->session()->flash('alert-success', "El módulo '{$request->module_title}' y el tema '{$request->topic_title}' ha sido actualizado correctamente.");

            return redirect()->route('study-plan.level-index', ['nivel' => $slug]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.create', ['nivel' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.create', ['nivel' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.create', ['nivel' => $slug]);
        }
    }

    public function edit($slug_level, $slug_module)
    {
        $module = Module::with(['topic' => function ($query) {
            return $query;
        }])->where('slug', $slug_module)->first();

        if (! $module) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view(
            'authenticated.administrator.study-plan.level.module.edit',
            [
                'module' => $module,
                'slug_level' => $slug_level,
                'slug_module' => $slug_module,
            ]
        );
    }

    public function update(ModuleUpdateRequest $request, $slug_level, $slug_module)
    {
        $module = Module::with(['topic' => function ($query) {
            return $query;
        }])->where('slug', $slug_module)->first();

        if (! $module) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

          if (
            Module::where('title', $request->module_title)
            ->whereNot('module_id', $module->module_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'module_title' =>
                        'Este nombre del modulo ya está registrado.'
                    ]
                );
        }
        try {
            FacadesDB::beginTransaction();

            $slug = Str::slug($request->module_title);
            $module->update([
                'title' => $request->module_title,
                'slug' => $slug,
            ]);

            FacadesDB::commit();

            $request->session()->flash('alert-success', "El módulo '{$module->title}' ha sido actualizado correctamente.");



            return redirect()->route('study-plan.level-index', ['nivel' => $slug_level]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $slug_level, 'slug' => $slug_module]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $slug_level, 'slug' => $slug_module]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $slug_level, 'slug' => $slug_module]);
        }
    }

    public function delete($slug_level, $slug_module)
    {
        $module = Module::with(['topic' => function ($query) {
            return $query;
        }])->where('slug', $slug_module)->first();

        if (! $module) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }


        return view(
            'authenticated.administrator.study-plan.level.module.delete',
            [
                'module' => $module,
                'slug_level' => $slug_level,
                'slug_module' => $slug_module
            ]
        );
    }

    public function destroy(Request $request, $level, $slug)
    {
        $module = Module::with(['topic' => function ($query) {
            return $query;
        }])->where('slug', $slug)->first();

        if (! $module) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }


        $module_id = $module->module_id;
        try {
            $countLessons = Lesson::whereHas('topic', function ($query) use ($module_id) {
                $query->where('module_id', $module_id);
            })->count();

            $countTopics = Topic::where('module_id', $module_id)->count();

            /*
         Lesson::whereHas('topic', function ($query) use ($module_id) {
                $query->where('module_id', $module_id);
            })->delete();

            Topic::where('module_id', $module_id)->delete();
         */

            Module::where('module_id', $module_id)->delete();

            $moduleName = $module->title;
            $module->delete();

            FacadesDB::commit();

            $mensaje = "El módulo '{$moduleName}' fue eliminado. ";
            $mensaje .= "Se removieron {$countTopics} temas y {$countLessons} lecciones asociadas.";

            $request->session()->flash('alert-success', $mensaje);

            return redirect()->route('study-plan.level-index', ['nivel' => $level]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $level, 'slug' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('module.edit', ['nivel' => $level, 'slug' => $slug]);
        }
    }
}
