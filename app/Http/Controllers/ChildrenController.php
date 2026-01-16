<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Children;
use App\Models\Gender;
use App\Models\Level;
use App\Models\Player;
use App\Models\Progress;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;


class ChildrenController extends Controller
{
    public function index()
    {
        $data = Player::with(['gender' => function ($query) {
            return $query;
        }])->with(['level_assigned' => function ($query) {
            return $query;
        }])->with(['user' => function ($query) {
            return $query;
        }])->paginate(5);


        return view('authenticated.adult.account.children.index', ['data' => $data]);
    }

    public function create()
    {
        $avatars = Avatar::all();
        $themes = Theme::all();
        $genders = Gender::all();
        $levels = Level::all();

        return view('authenticated.adult.account.children.create', [
            'avatars' => $avatars,
            'themes' => $themes,
            'genders' => $genders,
            'levels' => $levels,
        ]);
    }

    public function store(Request $request)
    {


        try {
            FacadesDB::beginTransaction();
            $only_name = explode(' ', $request->names);
            $only_lastname = explode(' ', $request->last_names);
            $slug = Str::slug($only_name[0] . '-' . $only_lastname[0] . '-' .  $request->Username);

            $newUser = new User();
            $newUser->rol_id = 3;
            $newUser->user = $request->username;
            $newUser->password = Hash::make($request->password);
            $newUser->email =  null;
            $newUser->save();
            $newChildren = new Player();

            $level = Level::where('level_id', $request->assigned_level)->first();
            if ($level->number != "1") {
                $newChildren->validated = 1;
            } else {
                $newChildren->validated = 0;
            }
            $newChildren->level_assigned_id = $request->assigned_level;
            $newChildren->current_level_id = $request->assigned_level;
            $newChildren->user_id = $newUser->user_id;
            $newChildren->names = $request->names;
            $newChildren->slug = $slug;
            $newChildren->surnames = $request->last_names;
            $newChildren->representative_id = Auth::user()->representative->representative_id;
            $newChildren->date_of_birth = $request->date_of_birth;
            $newChildren->gender_id = $request->gender_id;
            $newChildren->reading_mode = $request->reading_mode ?? 0;
            $newChildren->avatar_id = $request->avatar_id;
            $newChildren->theme_id = $request->theme_id;
            $esMasculino = ($request->gender_id == 1);
            $newChildren->save();

            $countLevels = Level::count();
            for ($i = 1; $i <= $countLevels; $i++) {
                $newProgress = new Progress();
                $newProgress->player_id = $newChildren->player_id;
                $levelProgress = Level::where('number', $i)->first();
                $newProgress->level_id = $levelProgress->level_id;
                $newProgress->state = 'Bloqueado';
                $newProgress->save();
            }

            $updateStateProgreso =  Progress::where('level_id', $request->assigned_level)->first();
            $updateStateProgreso->update([
                'state' => 'En Progreso'
            ]);
            $message = !$esMasculino ? 'La jugadora ha sido creada de manera exitosa' : 'El jugador  ha sido creado de manera exitoso';
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('children.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.create');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.create');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.create');
        }
    }

    public function delete($slug)
    {
        $data = Player::where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('authenticated.adult.account.children.delete', ['data' => $data]);
    }

    public function destroy(Request $request, $slug)
    {
        $data = Player::where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $user_id = $data->user_id;
        $nombreCompleto = $data->names . ' ' .  $data->surnames;
        $es_masculino = ($data->gender_id == 1);

        $message = !$es_masculino ? 'La jugadora <b>' . $nombreCompleto . ' </b>ha sido eliminada correctamente.' :
            'El jugador <b>' . $nombreCompleto . ' </b> ha sido elimado correctamente. ';
        try {
            FacadesDB::beginTransaction();
            $data->delete();
            User::where('user_id', $user_id)->delete();
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('children.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.delete-' . $es_masculino ? 'm' : 'f', $data->slug);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.delete' . $es_masculino ? 'm' : 'f', $data->slug);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('children.delete' . $es_masculino ? 'm' : 'f', $data->slug);
        }
    }
}
