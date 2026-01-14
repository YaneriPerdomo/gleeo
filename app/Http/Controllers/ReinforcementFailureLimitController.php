<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitialDecisionPatternsRequest;
use App\Models\ReinforcementFailureLimit;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ReinforcementFailureLimitController extends Controller
{
    public function index()
    {
        $data = ReinforcementFailureLimit::first();
        return view(
            'authenticated.administrator.system-configuration.initial-decision-patterns.index',
            [
                'data' => $data,
            ]
        );
    }
    public function edit()
    {
        $data = ReinforcementFailureLimit::first();
        return view(
            'authenticated.administrator.system-configuration.initial-decision-patterns.edit',
            [
                'data' => $data,
            ]
        );
    }

    public function update(InitialDecisionPatternsRequest $request)
    {
        $data = ReinforcementFailureLimit::firstOrFail();
        $decisionPattern = $data->decision_pattern;
        try {
            DB::beginTransaction();
            $data->update([
                'refuerzo_fail_limit' => $request->refuerzo_limit,
                'is_active' => $request->pattern_status == 'activo' ? 1 : 0,
            ]);

            DB::commit();
            $request->session()->flash('alert-success', 'Los Patrones de Decisión Iniciales del Tutor Inteligente han sido actualizado correctamente.');
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            return redirect('/configuracion-del-tutor/patrones-de-decision-iniciales/configurar');
        }
    }
}
