<?php

namespace App\Http\Controllers;

use App\Models\AlertConfiguration;
use App\Models\InterventionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->rol_id == 2) {
            $representativeID = Auth::user()->representative->representative_id;
            $notificationIsActiveCount = InterventionNotification::where('representative_id', $representativeID)
                ->where('is_read', 0)->count();

        }


        return view('authenticated.welcome', [
            'notificationIsActiveCount' => $notificationIsActiveCount || 0
        ]);
    }
}
