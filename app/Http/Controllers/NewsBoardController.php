<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralInformationUpdateRequest;
use App\Models\NewsBoard;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;

class NewsBoardController extends Controller
{
    public function index()
    {
        $data = NewsBoard::where('news_board_id', 1)->first();


        return view('authenticated.administrator.study-plan.general-information.index', [
            'data' => $data
        ]);
    }

    public function edit()
    {
        $data = NewsBoard::where('news_board_id', 1)->first();
        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }

        return view('authenticated.administrator.study-plan.general-information.edit', [
            'data' => $data
        ]);
    }

    public function update(GeneralInformationUpdateRequest $request)
    {
        $data = NewsBoard::where('news_board_id', 1)->first();

        if (! $data) {
            return back()->with('alert-danger', 'Sucedio un error: Registro no encontrado');
        }
        $user = $data->user;
        try {
            FacadesDB::beginTransaction();

            $data->update([
                'subject' => $request->subject,
                'description' => $request->description
            ]);

            FacadesDB::commit();

            $message = '¡La información general de la plataforma ha sido actualizada con éxito!';
            $request->session()->flash('alert-success', $message);
            return redirect()->route('news-board.edit');
        } catch (QueryException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('news-board.edit');
        } catch (PDOException $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('news-board.edit');
        } catch (Exception $ex) {
            $request->session()->flash('alert-danger', 'Sucedio un error: ' . $ex->getMessage());
            FacadesDB::rollBack();

            return redirect()->route('news-board.edit');
        }
    }
}
