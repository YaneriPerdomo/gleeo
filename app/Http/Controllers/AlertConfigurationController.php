<?php

namespace App\Http\Controllers;

use App\Models\AlertConfiguration;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Exception;

use Illuminate\Support\Facades\DB as FacadesDB;
class AlertConfigurationController extends Controller
{
    public function index()
    {
        Level::all()->each(function ($level) {
            AlertConfiguration::firstOrCreate(
                ['level_id' => $level->level_id],
                [
                    'state' => 0,
                    'time_frame' => '24 Horas',
                    'max_errors_allowed' => 5
                ]
            );
        });

        $data = AlertConfiguration::with(['level' => function ($query) {
            return $query;
        }])->get();



        return view(
            'authenticated.administrator.system-configuration.alert-thresholds.index',
            ['data' => $data]
        );
    }

    public function edit()
    {
        Level::all()->each(function ($level) {
            AlertConfiguration::firstOrCreate(
                ['level_id' => $level->level_id],
                [
                    'state' => 0,
                    'time_frame' => '24 Horas',
                    'max_errors_allowed' => 5
                ]
            );
        });

        $data = AlertConfiguration::with(['level' => function ($query) {
            return $query;
        }])->get();



        return view(
            'authenticated.administrator.system-configuration.alert-thresholds.edit',
            ['data' => $data]
        );
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $requestPackage = $request->except([
                '_method',
                '_token',
            ]);

            $itemNames = 0;
            foreach ($requestPackage as $value) {
                $itemNames++;
            }

            $numberOfItems = $itemNames / 4;


            for ($i = 1; $i <= $numberOfItems; $i++) {
                $AlertConfigId = 'id_' . $i;
                $maxErrorsAllowed = 'max_errors_allowed_' . $i;
                $timeWindow = 'time_window_' . $i;
                $state = 'state_' . $i;
                $AlertConfig = AlertConfiguration::where('alert_config_id', $requestPackage[$AlertConfigId])->first();

                $AlertConfig->max_errors_allowed =  intval($requestPackage[$maxErrorsAllowed]) ?? 0;
                $AlertConfig->time_frame = $requestPackage[$timeWindow];
                $AlertConfig->state = $requestPackage[$state] == 'inactivo' ? 0 : 1;
                $AlertConfig->save();
            }
            DB::commit();

            $message = 'Se han actualizado correctamente los umbrales de intervención.';
            $request->session()->flash('alert-success', $message);
            return redirect()->route('alert-thresholds.edit');
          } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('alert-thresholds.edit');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('alert-thresholds.update');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();
            return redirect()->route('alert-thresholds.update');
        }
    }
}
