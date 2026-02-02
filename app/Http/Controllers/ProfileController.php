<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountPersonalEditRequest;
use App\Http\Requests\PasswordConfirmationRequest;
use App\Http\Requests\PersonalInformationEditRequest;
use App\Http\Requests\PersonalInformationUpdateRequest;
use App\Models\InterventionNotification;
use App\Models\Representative;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class ProfileController extends Controller
{
    public function IndexPersonal()
    {
        $data = Representative::with(['user' => function ($query) {
            return $query;
        }])->where('user_id', FacadesAuth::user()->user_id)->first();
        $notificationIsActiveCount = 0;
        if (FacadesAuth::user()->rol_id == 2) {
            $representativeID = FacadesAuth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }

        return view('authenticated.profile.personal-information.index', [
            'data' => $data,
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }

    public function IndexAccount()
    {
        $data = User::select('user_id', 'user', 'email')->where('user_id', FacadesAuth::user()->user_id)->first();
        $notificationIsActiveCount = 0;
        if (FacadesAuth::user()->rol_id == 2) {
            $representativeID = FacadesAuth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.profile.account-information.index', ['data' => $data, 'notificationIsActiveCount' => $notificationIsActiveCount || 0]);
    }



    public function editPersonal()
    {
        $data = Representative::with(['user' => function ($query) {
            return $query;
        }])->where('user_id', FacadesAuth::user()->user_id)->first();
        $notificationIsActiveCount = 0;
        if (FacadesAuth::user()->rol_id == 2) {
            $representativeID = FacadesAuth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }

        return view('authenticated.profile.personal-information.edit', ['data' => $data, 'notificationIsActiveCount' => $notificationIsActiveCount]);
    }

    public function updatePersonal(PersonalInformationUpdateRequest $request)
    {

        $data = Representative::where('user_id', FacadesAuth::user()->user_id)->first();
        try {
            FacadesDB::beginTransaction();
            $data->update([
                'type' => $request->role_identification,
                'gender_id' => $request->gender_id,
                'educational_center' => $request->educational_center
            ]);
            FacadesDB::commit();
            $request->session()->flash('alert-success', 'La Información personal ha sido actualizada correctamente.');

            return redirect()->route('personal-profile.edit');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('personal-profile.edit');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('personal-profile.edit');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('personal-profile.edit');
        }
    }

    public function EditAccount()
    {
        $data = User::select('user_id', 'user', 'email')->where('user_id', FacadesAuth::user()->user_id)->first();

        $notificationIsActiveCount = 0;
        if (FacadesAuth::user()->rol_id == 2) {
            $representativeID = FacadesAuth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.profile.account-information.edit', ['data' => $data, 'notificationIsActiveCount' => $notificationIsActiveCount]);
    }

    public function updateAccount(AccountPersonalEditRequest $request)
    {
        $data = User::select('user_id', 'user', 'email')->where('user_id', FacadesAuth::user()->user_id)->firstOrFail();

        if (
            User::where('user', $request->user_name)
            ->whereNot('user_id', FacadesAuth::user()->user_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'user_name' => 'El nombre de usuario  ya está en uso. Por favor, elige uno diferente',
                    ]
                );
        }

        if (
            User::where('email', $request->email)
            ->whereNot('user_id', FacadesAuth::user()->user_id)->exists()
        ) {
            return redirect()->back()
                ->withInput()
                ->withErrors(
                    [
                        'email' => 'El correo electrónico ya está en uso. Por favor, elige uno diferente',
                    ]
                );
        }

        try {
            FacadesDB::beginTransaction();
            $data->update([
                'email' => $request->email,
                'user' => $request->user_name,
            ]);
            FacadesDB::commit();
            $request->session()->flash('alert-success', 'La Información del usuario ha sido actualizada correctamente.');

            return redirect()->route('account-profile.edit');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('account-profile.edit');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('account-profile.edit');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('account-profile.edit');
        }
    }

    public function ChangePasswordEdit()
    {
        $notificationIsActiveCount = 0;
        if (FacadesAuth::user()->rol_id == 2) {
            $representativeID = FacadesAuth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view('authenticated.profile.change-password', ['notificationIsActiveCount' => $notificationIsActiveCount]);
    }

    public function ChangePasswordUpdate(PasswordConfirmationRequest $request)
    {
        try {
            FacadesDB::beginTransaction();
            $data_user = User::find(FacadesAuth::user()->user_id);

            $data_user->update([
                'password' => Hash::make($request->password),
            ]);
            $request->session()->flash(
                'alert-success',
                'La contraseña ha sido actualizada.'
            );
            FacadesDB::commit();

            return redirect()->route('change-password.edit');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('change-password.edit');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('change-password.edit');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());

            return redirect()->route('change-password.edit');
        }
    }

    public function verification() {}
}
