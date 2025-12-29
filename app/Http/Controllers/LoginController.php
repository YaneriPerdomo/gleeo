<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {

        $credentials = $request->only('user', 'password');
        if (FacadesAuth::attempt($credentials)) {

            if (FacadesAuth::user()->deleted_at == 0) {
                return back()->with([
                    'alert-danger' => 'Lo sentimos, tu cuenta de usuario ha sido eliminado. Si tiene alguna duda, comunícate con el administrador.'
                ]);
            }
            if (FacadesAuth::user()->state == 0) {
                return back()->withErrors([
                    'alert-danger' => 'Lo sentimos, tu cuenta de usuario está deshabilitada. Para obtener asistencia, comunícate con el administrador.'
                ]);
            }
            $request->session()->regenerate();
            if (FacadesAuth::user()->rol_id == 3) {
                $request->session()->put('user_id', FacadesAuth::user()->user_id);
                $player = Player::where('user_id', FacadesAuth::id())->first();
                if ($player) {
                    $request->session()->put('player_id', $player->player_id);
                }
                $request->session()->put('current_level_id', $player->level_assigned_id);
                return redirect()->route('educational-platform.index', ['slugCurrentLevel' => $player->level_assigned->slug]);
            }
            return redirect()->intended('/inicio');
        } else {
            return back()->withErrors([
                'message_incorrect_credentials' => 'Credenciales incorrectas'
            ]);
        }
    }
    public function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index');
    }
}
