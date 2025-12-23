<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Module;
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
        }])->orderBy('number', 'ASC')->paginate(10);


        return view(
            'authenticated.administrator.study-plan.index',
            [
                'levels' => $levels,
                'isRelativeURL' => '../',
                'isStateSearch' => false,
                'searchValue' => '',
            ]
        );
    }

    public function level($level)
    {
        $string = $level;
        $numero = preg_replace('/[^0-9]/', '', $string);


        $levelModel = Level::where('number', $numero)->first();
        $modules = Module::where('level_id', $levelModel->level_id)
            ->with(['topics' => function ($query) {
                return $query->with(['lessons' => function ($query) {
                    $query;
                }]);
            }])
            ->paginate(5);
        return view(
            'authenticated.administrator.study-plan.level.index',
            [
                'modules' => $modules,
                'infoLevel' => [
                    'slug' => $level,
                    'number' => $numero,
                    'name' => $levelModel->name
                ]
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

            $slug = Str::slug($request->level_title);

            $level_new = new Level();
            $level_new->name = $request->level_title;
            $level_new->slug = $slug;
            $level_new->number = strval($request->number_level);
            $level_new->save();



            FacadesDB::commit();

            $request->session()->flash('alert-success', "¡Éxito! El nivel '{$request->level_title}' (N° {$request->number_level}) se ha agregado correctamente.");

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

    public function edit() {}

    public function update() {}
    public function delete() {}
    public function destroy() {}

    public function filter($search)
    {
        $test = explode('[', $search);
        $search_l =  str_replace(']', '', $test[1]);

        $levels = Level::with(['module' => function ($query) {
            return $query;
        }])
        ->where('name' ,'LIKE' , '%'.trim($search_l).'%')
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
