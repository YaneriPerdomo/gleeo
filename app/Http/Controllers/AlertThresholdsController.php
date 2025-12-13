<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlertThresholdsRequest;
use App\Models\AlertThreshold;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AlertThresholdsController extends Controller
{
    public function index()
    {
        $data = AlertThreshold::select('refuerzo_fail_limit', 'decision_pattern_id', 'alert_ce_activations', 'time_window')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'like', '%Alerta Intervención Requerida%');
            })->with(['decision_pattern' => function ($query) {
                return $query->select('name', 'decision_pattern_id', 'is_active');
            }])
            ->get();

        return view(
            'authenticated.administrator.system-configuration.alert-thresholds.index',
            ['data' => $data]
        );
    }

    public function edit()
    {
        $data = AlertThreshold::select('refuerzo_fail_limit', 'decision_pattern_id', 'alert_ce_activations', 'time_window')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'like', '%Alerta Intervención Requerida%');
            })->with(['decision_pattern' => function ($query) {
                return $query->select('name', 'decision_pattern_id', 'is_active');
            }])
            ->get();

        return view(
            'authenticated.administrator.system-configuration.alert-thresholds.edit',
            ['data' => $data]
        );
    }

    public function update(AlertThresholdsRequest $request)
    {
        $data_basico = AlertThreshold::select('alert_threshold_id', 'decision_pattern_id', 'alert_ce_activations', 'time_window')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Alerta Intervención Requerida, PreNumérico');
            })
            ->firstOrFail();
        $data_intermedio = AlertThreshold::select('alert_threshold_id', 'decision_pattern_id', 'alert_ce_activations', 'time_window')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Alerta Intervención Requerida, Numérico Emergente');
            })
            ->firstOrFail();
        $data_avanzado = AlertThreshold::select('alert_threshold_id','decision_pattern_id', 'alert_ce_activations', 'time_window')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Alerta Intervención Requerida, Desarrollo Emergente');
            })
            ->firstOrFail();
        try {

            DB::beginTransaction();
            $data_basico->alert_ce_activations = (int) $request->alert_activations_threshold_basic;
            $data_basico->time_window = $request->time_window_basic;
            $data_basico->save();
            $data_intermedio->alert_ce_activations = (int) $request->alert_activations_threshold_intermediate;
            $data_intermedio->time_window = $request->time_window_intermediate;
            $data_intermedio->save();
            $data_avanzado->alert_ce_activations = (int) $request->alert_activations_threshold_advanced;
            $data_avanzado->time_window = $request->time_window_advanced;
            $data_avanzado->save();
            DB::commit();


            $request->session()->flash('alert-success', 'Los Umbrales de Intervención han sido actualizados correctamente.');
            return redirect('/configuracion-del-tutor/alerta-intervencion-requerida/configurar');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            DB::rollBack();
            return redirect('/configuracion-del-tutor/alerta-intervencion-requerida/configurar');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            DB::rollBack();
            return redirect('/configuracion-del-tutor/alerta-intervencion-requerida/configurar');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            DB::rollBack();
            return redirect('/configuracion-del-tutor/alerta-intervencion-requerida/configurar');
        }
    }
}
