<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildStoreRequest;
use App\Models\Avatar;
use App\Models\Children;
use App\Models\Gender;
use App\Models\InterventionNotification;
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

        $idUser = Auth::user()->representative->representative_id;
        $data = Player::with(['gender' => function ($query) {
            return $query;
        }])
            ->with(['level_assigned' => function ($query) {
                return $query;
            }])->with(['user' => function ($query) {
                return $query;
            }])
            ->where('representative_id', $idUser)
            ->paginate(5);

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }

        return view('authenticated.adult.account.children.index', [
            'data' => $data,
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }

    public function filter($search)
    {
        $idUser = Auth::user()->user_id;
        $test = explode('[', $search);
        $search_l =  str_replace(']', '', $test[1]);
        $data = Player::with(['gender' => function ($query) {
            return $query;
        }])->with(['level_assigned' => function ($query) {
            return $query;
        }])->with(['user' => function ($query) {
            return $query;
        }])
            ->where('representative_id', $idUser)
            ->where('names',   'like', '%' . $search_l . '%')
            ->orWhere('surnames', 'like', '%' . $search_l . '%')
            ->paginate(5);

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view(
            'authenticated.adult.account.children.index',
            [
                'data' => $data,
                'searchValue' => $search_l,
                'notificationIsActiveCount' => $notificationIsActiveCount
            ]
        );
    }
    public function create()
    {
        $avatars = Avatar::all();
        $themes = Theme::all();
        $genders = Gender::all();
        $levels = Level::all();

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.adult.account.children.create', [
            'avatars' => $avatars,
            'themes' => $themes,
            'genders' => $genders,
            'levels' => $levels,
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }

    public function store(ChildStoreRequest $request)
    {


        try {
            FacadesDB::beginTransaction();
            $only_name = explode(' ', $request->names);
            $only_lastname = explode(' ', $request->last_names);
            $slug = Str::slug($only_name[0] . '-' . $only_lastname[0] . '-' .  $request->user);

            $newUser = new User();
            $newUser->rol_id = 3;
            $newUser->user = $request->user;
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
            $newChildren->representative_id = Auth::user()->representative->representative_id;;
            $newChildren->date_of_birth = $request->date_of_birth;
            $newChildren->gender_id = $request->gender_id;

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
                if ($i == 1) {
                    $newProgress->state = 'En Progreso';
                } else {
                    $newProgress->state = 'Bloqueado';
                }
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
        $idUser = Auth::user()->representative->representative_id;
        $data = Player::where('slug', $slug)
            ->where('representative_id', $idUser)
            ->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.adult.account.children.delete', [
            'data' => $data,
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }

    public function destroy(Request $request, $slug)
    {
        $idUser = Auth::user()->user_id;
     $representativeID = Auth::user()->representative->representative_id;
        $data = Player::where('slug', $slug)
            ->where('representative_id', $representativeID)
            ->first();

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

    public function edit($slug)
    {
        $avatars = Avatar::all();
        $themes = Theme::all();
        $genders = Gender::all();
        $levels = Level::all();
        $data = Player::where('slug', $slug)->first();

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.adult.account.children.edit', [
            'data' => $data,
            'avatars' => $avatars,
            'themes' => $themes,
            'genders' => $genders,
            'levels' => $levels,
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }

    public function update(Request $request, $slug)
    {
        $idUser = Auth::user()->user_id;

        $data = Player::where('slug', $slug)
            ->where('representative_id', $idUser)
            ->first();
        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        try {
            $url = 'children.edit-';
            $url .= $data->gender_id == 1 ? 'm' : 'f';
            FacadesDB::beginTransaction();
            $only_name = explode(' ', $request->names);
            $only_lastname = explode(' ', $request->last_names);
            $slugNew = Str::slug($only_name[0] . '-' . $only_lastname[0] . '-' .  $request->Username);
            $newUser = $data->user;
            $newUser->user = $request->username;
            if ($request->password  != '') {
                $newUser->password = Hash::make($request->password);
            }
            $newUser->email =  null;
            $newUser->save();
            $newChildren = $data;
            $newChildren->level_assigned_id = $request->assigned_level;
            $newChildren->names = $request->names;
            $newChildren->slug = $slugNew;
            $newChildren->surnames = $request->last_names;
            $newChildren->date_of_birth = $request->date_of_birth;
            $newChildren->gender_id = $request->gender_id;

            $newChildren->avatar_id = $request->avatar_id;
            $newChildren->theme_id = $request->theme_id;
            $esMasculino = ($request->gender_id == 1);
            $newChildren->save();
            $message = !$esMasculino ? 'La jugadora ha sido actualizada de manera exitosa' : 'El jugador  ha sido actualizado de manera exitoso';
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            $url = 'children.edit-';
            $url .= $esMasculino ? 'm' : 'f';
            return redirect()->route($url, ['slug' => $slugNew]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route($url, ['slug' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route($url, ['slug' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route($url, ['slug' => $slug]);
        }
    }
}
