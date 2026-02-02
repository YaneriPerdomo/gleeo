<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarStoreRequest;
use App\Http\Requests\AvatarUpdateRequest;
use App\Models\Avatar;
use App\Models\Player;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use PDOException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AvatarController extends Controller
{
    public function index()
    {
        $data = Avatar::paginate(5);
        return view('authenticated.administrator.study-plan.avatar.index', [
            'data' => $data
        ]);
    }

    public function filter($search)
    {
        $test = explode('[', $search);
        $search_l = str_replace(']', '', $test[1]);

        $data = Avatar::where('name', 'LIKE', '%' . trim($search_l) . '%')->paginate(5);

        return view(
            'authenticated.administrator.study-plan.avatar.index',
            [
                'data' => $data,
                'isRelativeURL' => '../',
                'isStateSearch' => false,
                'searchValue' => $search_l,
            ]
        );
    }
    public function create()
    {
        return view('authenticated.administrator.study-plan.avatar.create');
    }

    public function store(AvatarStoreRequest $request)
    {
        try {
            FacadesDB::beginTransaction();

            $slug = Str::slug($request->name_avatar);
            $newAvatar = new Avatar();
            $newAvatar->slug = $slug;
            $newAvatar->name = $request->name_avatar;
            if ($request->hasFile('avatar_path')) {
                /**$oldImagePath = public_path('logo-de-la-empresa.png');
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    } */
                $router = 'img/avatars';
                $img = $request->file('avatar_path');
                $nameName = $img->getClientOriginalName();
                $img->move($router, $nameName);
                $newAvatar->url = $nameName;
            }

            $newAvatar->save();

            FacadesDB::commit();

            $request->session()->flash('alert-success', "El Avatar '{$request->name_avatar}'  ha sido agregado correctamente.");

            return redirect()->route('avatar.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.create');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.create');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.create');
        }
    }

    public function delete($slug)
    {
        $data = Avatar::select(
            'avatar_id',
            'name',
            'url',
            'slug'
        )->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $countAvatar = Player::where('avatar_id', $data->avatar_id)->count();

        return view(
            'authenticated.administrator.study-plan.avatar.delete',
            [
                'data' => $data,
                'countAvatar' => $countAvatar
            ]
        );
    }

    public function destroy(Request $request, $slug)
    {
        $data = Avatar::select(
            'avatar_id',
            'name',
            'url',
            'slug'
        )->where('slug', $slug)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        $message = '';
        try {

            $players = Player::where('avatar_id', $data->avatar_id)->get();
            FacadesDB::beginTransaction();
            $players = Player::updated([
                'avatar_id' => 1
            ]);
            $nameAvatar = $data->name;

            $oldImagePath = public_path('img/avatars/' . $data->url);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $data->delete();

            FacadesDB::commit();
            $message = 'El avatar llamado ' . $nameAvatar . ' ha sido eliminado correctamente! ';
            $request->session()->flash('alert-success', $message);
            return redirect()->route('avatar.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('avatar.delete');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('avatar.delete');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('avatar.delete');
        }
    }

    public function edit(Request $request, $slug)
    {
        $data = Avatar::where('slug', $slug)->first();
        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        return view(
            'authenticated.administrator.study-plan.avatar.edit',
            [
                'data' => $data,

            ]
        );
    }

    public function update(AvatarUpdateRequest $request, $slug)
    {
        $data = Avatar::where('slug', $slug)->first();
        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        if (
            Avatar::where('name', $request->name_avatar)
            ->whereNot('avatar_id', $data->avatar_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'name' =>
                        'Este nombre del Avatar ya está registrado.'
                    ]
                );
        }
        if (
            Avatar::where('url', $request->name_avatar)
            ->whereNot('avatar_id', $data->avatar_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'name_avatar' =>
                        'Esta imagen de perfil ya está registrada.'
                    ]
                );
        }
        try {
            FacadesDB::beginTransaction();
            $slugNew = Str::slug($request->name_avatar);
            $data->name = $request->name_avatar;
            $data->slug = $slugNew;
            if ($request->hasFile('avatar_path')) {
                $file = $request->file('avatar_path');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('img/avatars');
                if (!empty($data->url)) {
                    $oldImagePath = $destinationPath . '/' . $data->url;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                $file->move($destinationPath, $fileName);
                $data->url = $fileName;
            }
            $data->save();
            FacadesDB::commit();
            $request->session()->flash('alert-success', 'El Avatar se ha actualizado correctamente.');
            return redirect()->route('avatar.edit', $slugNew);
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.edit', $slug);
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.edit', $slug);
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('avatar.edit', $slug);
        }
    }
}
