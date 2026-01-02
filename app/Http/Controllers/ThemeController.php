<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Theme;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use PDOException;
use Illuminate\Support\Facades\File;


class ThemeController extends Controller
{
    public function index()
    {

        $data = Theme::paginate(5);
        return view('authenticated.administrator.study-plan.theme.index', ['data' => $data]);
    }

    public function filter($search)
    {
        $test = explode('[', $search);
        $search_l = str_replace(']', '', $test[1]);

        $data = Theme::where('name', 'LIKE', '%' . trim($search_l) . '%')->paginate(5);

        return view(
            'authenticated.administrator.study-plan.theme.index',
            [
                'data' => $data,
                'isStateSearch' => false,
                'searchValue' => $search_l,
            ]
        );
    }
    public function create()
    {
        return view('authenticated.administrator.study-plan.theme.create');
    }
    public function store(Request $request)
    {


        try {
            FacadesDB::beginTransaction();

            $slug = Str::slug($request->theme_title);
            $newTheme = new Theme();
            $newTheme->slug = $slug;
            $newTheme->name = $request->theme_title;
            $newTheme->main_color = $request->main_color;
            $newTheme->secondary_color = $request->secondary_color;
            if ($request->solid_background == '#ffffff') {
                if ($request->hasFile('background_path')) {
                    /**$oldImagePath = public_path('logo-de-la-empresa.png');
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    } */
                    $router = 'img/themes';
                    $img = $request->file('background_path');
                    $nameName = $img->getClientOriginalName();
                    $img->move($router, $nameName);
                    $newTheme->background_path = $nameName;
                    $newTheme->solid_background = null;
                }
            } else {
                $newTheme->solid_background = $request->solid_background;
                $newTheme->background_path = null;
            }

            $newTheme->border_radius = $request->border_radius ?? 0;
            $newTheme->topic_color = $request->topic_color;
            $newTheme->save();

            FacadesDB::commit();

            $request->session()->flash('alert-success', "El tema de interfaz '{$request->theme_title}'  ha sido agregado correctamente.");

            return redirect()->route('theme.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('theme.create');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('theme.create');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('theme.create');
        }
    }
    public function edit() {}

    public function update() {}


    public function delete($slug)
    {
        $theme = Theme::where('slug', $slug)->first();
        if (! $theme) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $countThemes = Player::where('theme_id', $theme->theme_id)->count();
        return view('authenticated.administrator.study-plan.theme.delete', [
            'theme' => $theme,
            'countThemes' => $countThemes
        ]);
    }

    public function destroy(Request $request, $slug)
    {
        $data = Theme::where('slug', $slug)->first();
        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $message = '';
        try {
            FacadesDB::beginTransaction();
            $players = Player::where('theme_id', $data->theme_id)->get();
            $players = Player::updated([
                'theme_id' => 1
            ]);
            $nameTheme = $data->name;
            $oldImagePath = public_path('img/themes/' . $data->url);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $data->delete();
            FacadesDB::commit();
            $message = 'El Tema llamado ' . $nameTheme . ' ha sido eliminado correctamente! ';
            $request->session()->flash('alert-success', $message);
            return redirect()->route('theme.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('theme.delete');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('theme.delete');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('theme.delete');
        }
    }
}
