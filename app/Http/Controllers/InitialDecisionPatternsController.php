<?php
namespace App\Http\Controllers;

use App\Http\Requests\InitialDecisionPatternsRequest;
use App\Models\AlertThreshold;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use PDOException;
class InitialDecisionPatternsController extends Controller
{
    public function index()
    {
        $data = AlertThreshold::select('refuerzo_fail_limit', 'decision_pattern_id')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Activación del Contenido de Esfuerzo');
            })->with(['decision_pattern' => function ($query) {
                return $query->select('name', 'decision_pattern_id', 'is_active');
            }])
            ->first();
        return view(
            'authenticated.administrator.system-configuration.initial-decision-patterns.index',
            [
                'data' => $data,
            ]
        );
    }
    public function edit()
    {
        $data = AlertThreshold::select('refuerzo_fail_limit', 'decision_pattern_id')
            ->whereHas('decision_pattern', function ($query) {
                return $query->where('name', 'Activación del Contenido de Esfuerzo');
            })->with(['decision_pattern' => function ($query) {
                return $query->select('name', 'decision_pattern_id', 'is_active');
            }])
            ->first();
        return view(
            'authenticated.administrator.system-configuration.initial-decision-patterns.edit',
            [
                'data' => $data,
            ]
        );
    }

    public function update(InitialDecisionPatternsRequest $request)
    {
        $data = AlertThreshold::whereHas('decision_pattern', function ($query) {
            $query->where('name', 'Activación del Contenido de Esfuerzo');
        })->firstOrFail();
        $decisionPattern = $data->decision_pattern;
        try {
            FacadesDB::beginTransaction();
            $data->update([
                'refuerzo_fail_limit' => $request->refuerzo_limit,
            ]);
            if ($decisionPattern) {
                $decisionPattern->update([
                    'is_active' => $request->pattern_status == 'activo' ? 1 : 0,
                ]);
            }
            FacadesDB::commit();
            $request->session()->flash('alert-success', 'Los Patrones de Decisión Iniciales del Tutor Inteligente han sido actualizado correctamente.');
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: '.$ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        }
    }
}
