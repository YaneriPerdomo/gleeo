<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index(){
       return view('auth.login');
    }

    public function auth (Request $request){

        $credentials = $request->only('user', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->state == 0) {
                return back()->withErrors([
                    'message_incorrect_credentials' => 'Lo sentimos, tu cuenta de usuario está deshabilitada. Para obtener asistencia, comunícate con el administrador.'
                ]);
            }
            $request->session()->regenerate();
            if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3 ) {
                /*
                    $user = Employee::where('user_id', Auth::user()->user_id)->first();
                    $user->last_session = Carbon::now();
                    $user->save();
                    $user = Auth::user()->load('employee');
                    $request->session()->put('name_lastname', $user->employee->name . ' ' . $user->employee->lastname);
                    $gender = Auth::user()->employee->gender_id == 1 ? '/bienvenido' : '/bienvenida';
                    return redirect()->intended($gender);
                */
                //redirect()->intended($gender);
            }
            return redirect()->intended('/bienvenido-a');

        } else {
            return back()->withErrors([
                'message_incorrect_credentials' => 'Credenciales incorrectas'
            ]);
        }
    }
      public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/autorizacion/iniciar-sesion');
    }

}
