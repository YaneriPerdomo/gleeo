<?php

namespace App\Http\Controllers;

use App\Models\InterventionNotification;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;
use Illuminate\Http\Request;


class InterventionNotificationController extends Controller
{
    public function index()
    {
        $representativeID = Auth::user()->representative->representative_id;
        $data = InterventionNotification::where('representative_id', $representativeID)->paginate(5);

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view(
            'authenticated.adult.intervention-notification.index',
            [
                'data' => $data,
                'notificationIsActiveCount' => $notificationIsActiveCount,
                'isRelativeURL' => '../',
                'isStateSearch' => false,
                'searchValue' => '',
            ]
        );
    }

    public function filter($search)
    {
        $idUser = Auth::user()->user_id;
        $test = explode('[', $search);
        $search_l =  str_replace(']', '', $test[1]);

        $representativeID = Auth::user()->representative->representative_id;
        $data = InterventionNotification::whereHas('player', function ($query) use ($search_l) {
            $query->where('names',   'like', '%' . $search_l . '%')
                ->orWhere('surnames', 'like', '%' . $search_l . '%');
        })->where('representative_id', $representativeID)->paginate(5);

        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();
        }
        return view(
            'authenticated.adult.intervention-notification.index',
            [
                'data' => $data,
                'notificationIsActiveCount' => $notificationIsActiveCount,
                'searchValue' => $search_l,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        try {
            FacadesDB::beginTransaction();
            $data = InterventionNotification::where('notification_id', $id)->first();
            $data->is_read = 1;
            $data->save();
            $message = 'La notificación ha sido leída correctamente.';
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('invervention-notification.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        }
    }
    public function updateAll(Request $request)
    {
        try {
            FacadesDB::beginTransaction();
            InterventionNotification::where('representative_id', $request->representative_id)
                ->where('is_read', 0)
                ->update([
                    'is_read' => 1
                ]);

            $message = 'Las notificaciones han sido leidas correctamente.';
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('invervention-notification.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            FacadesDB::beginTransaction();
            $data = InterventionNotification::where('notification_id', $id)->first();

            $data->delete();
            $message = 'La notificación ha sido eliminada correctamente.';
            FacadesDB::commit();
            $request->session()->flash('alert-success', $message);
            return redirect()->route('invervention-notification.index');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('invervention-notification.index');
        }
    }
}
