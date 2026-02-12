<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeStoreRequest;
use App\Http\Requests\RepresentativeUpdateRequest;
use App\Models\Country;
use App\Models\Representative;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;

class RepresentativeController extends Controller
{
    public function index()
    {
        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'type',
            'created_at',
            'country_id',
            'educational_center',
        )->with(['country' => function ($query) {
            return $query;
        }])->with(['gender' => function ($query) {
            return $query;
        }])->with(['user' => function ($query) {
            return $query->select('user_id', 'user', 'email', 'last_session', 'state', 'rol_id');
        }])->paginate(5);

        return view(
            'authenticated.administrator.account.representative.index',
            [
                'data' => $data,
                'isRelativeURL' => '../',
                'isStateSearch' => false,
                'searchValue' => '',
            ]
        );
    }


    public function filter($search)
    {
        $test = explode('[', $search);
        $search_l =  str_replace(']', '', $test[1]);
        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'type',
            'created_at',
            'country_id',
            'educational_center',
        )->with(['country' => function ($query) {
            return $query;
        }])->with(['gender' => function ($query) {
            return $query;
        }])->whereHas('user', function ($query) use ($search_l) {
            return $query->where('email',  'like', '%' . $search_l . '%')
                ->orWhere('user',  'like', '%' . $search_l . '%');
        })->with(['user' => function ($query) {
            return $query->select('user_id', 'user', 'email', 'last_session', 'state', 'rol_id');
        }])->paginate(5);


        return view(
            'authenticated.administrator.account.representative.index',
            [
                'data' => $data,
                'searchValue' => $search_l,
            ]
        );
    }

    public function create(RepresentativeStoreRequest $request)
    {

        $country_selected = Country::where('country', $request->country_name)->first();
        $country_selected->country_id;

        try {
            FacadesDB::beginTransaction();
            $slug = Str::slug($request->user);
            $user = User::create([
                'user' => $request->user,
                'email' => $request->email,
                'state' => 1,
                'rol_id' => 2,
                'password' => Hash::make($request->password),
            ]);
            $data = Representative::create([
                'names' => '',
                'surnames' => '',
                'educational_center' => $request->role_identification == 'Profesional' ? $request->educational_center : '',
                'type' => $request->role_identification,
                'slug' => $slug,
                'country_id' => $country_selected->country_id,
                'gender_id' => $request->gender_id,
                'user_id' => $user->user_id,
            ]);

            $message = 'La cuenta ha sido creada correctamente.';
            FacadesDB::commit();

            $request->session()->flash('alert-success', $message);

            return redirect()->route('login.index');
        } catch (QueryException $ex) {
            FacadesDB::rollBack();
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('create-account.index');
        } catch (PDOException $ex) {
            FacadesDB::rollBack();

            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('create-account.index');
        } catch (Exception $ex) {
            FacadesDB::rollBack();

            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('create-account.index');
        }
    }

    public function edit($slug)
    {

        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'created_at',
            'country_id',
            'type',
            'educational_center',
        )->with(['country' => function ($query) {
            return $query;
        }])->with(['gender' => function ($query) {
            return $query;
        }])->with(['user' => function ($query) {
            return $query->select('user_id', 'user', 'state', 'email', 'last_session', 'rol_id')
                ->with(['rol' => function ($query) {
                    return $query;
                }]);
        }])->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $countries = Country::all();

        return view(
            'authenticated.administrator.account.representative.edit',
            [
                'data' => $data,
                'countries' => $countries,
            ]
        );
    }

    public function update(RepresentativeUpdateRequest $request, $slug)
    {
        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'created_at',
            'country_id',
            'type',
            'educational_center',
        )->with(['country' => function ($query) {
            return $query;
        }])->with(['gender' => function ($query) {
            return $query;
        }])->with(['user' => function ($query) {
            return $query->select('user_id', 'user', 'state', 'email', 'last_session', 'rol_id')
                ->with(['rol' => function ($query) {
                    return $query;
                }]);
        }])->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $user = $data->user;


        if (
            User::where('user', $user->user)
            ->whereNot('user_id', $data->user_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'Username' =>
                        'Este nombre de usuario ya está registrado.'
                    ]
                );
        }

        if (
            User::where('email', $user->email)
            ->whereNot('user_id', $data->user_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'email' =>
                        'Este correo electrónico ya está registrado.'
                    ]
                );
        }
        try {
            FacadesDB::beginTransaction();
            /*$only_name = explode(' ', $request->name);
            $only_lastname = explode(' ', $request->surnames);*/
            $slug = Str::slug($request->Username);

            $data->update([
                /*'names' => $request->name,
                'surnames' => $request->surnames,*/
                'educational_center' => $request->role_identification == 'Profesional' ? $request->educational_center : '',
                'type' => $request->role_identification,
                'slug' => $slug,
                'gender_id' => $request->gender_id,

                'country_id' => $request->country_id,

            ]);

            if ($request->password != '' && $request->password_confirmation != '') {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $user->update([
                'user' => $request->Username,
                'email' => $request->email,
                'state' => $request->pattern_status,
            ]);

            $rol = $request->role_identification;
            $es_masculino = ($request->gender_id == 1);
            if ($rol === 'Profesional') {
                if ($es_masculino) {
                    $identificador = 'del Profesional';
                } else {
                    $identificador = 'de la Profesional';
                }
            } else {
                if ($es_masculino) {
                    $identificador = 'del Representante';
                } else {
                    $identificador = 'de la Representante';
                }
            }

            $a_o = $es_masculino ? 'o' : 'a';
            $message = 'La Información ' . $identificador . ' ha sido Actualizad' . $a_o . ' Correctamente.';
            FacadesDB::commit();

            $request->session()->flash('alert-success', $message);

            return redirect()->route('representative.edit', ['slug' => $slug]);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.edit', ['slug' => $slug]);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.edit', ['slug' => $slug]);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.edit', ['slug' => $slug]);
        }
    }

    public function delete($slug)
    {

        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'created_at',
            'country_id',
            'type',
            'educational_center',
        )->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view(
            'authenticated.administrator.account.representative.delete',
            [
                'data' => $data,
            ]
        );
    }

    public function destroy(Request $request, $slug)
    {

        $data = Representative::select(
            'representative_id',
            'gender_id',
            'user_id',
            'names',
            'surnames',
            'slug',
            'created_at',
            'country_id',
            'type',
            'educational_center',
        )->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $user_id = $data->user_id;
        $rol = $data->role_identification;
        $es_masculino = ($data->gender_id == 1);
        if ($rol === 'Profesional') {
            if ($es_masculino) {
                $identificador = 'La Profesional';
            } else {
                $identificador = 'El Profesional';
            }
        } else {
            if ($es_masculino) {
                $identificador = 'El Representante';
            } else {
                $identificador = 'La Representante';
            }
        }
        $a_o = $es_masculino ? 'o' : 'a';
        $message = $identificador . ' <b>' . $data->user->user . ' </b> ha sido Eliminad' . $a_o . ' Correctamente.';
        try {
            FacadesDB::beginTransaction();
            $data->delete();
            User::where('user_id', $user_id)->delete();
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('representative.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.delete');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.delete');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('representative.delete');
        }
    }


}
