<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Module;
use Illuminate\Http\Request;

class EducationalPlatformController extends Controller
{
    public function index($slugCurrentLevel)
    {

        $currentLevel = Level::where('slug', $slugCurrentLevel)->first();
        $CurrentModules = Module::where('level_id', $currentLevel->level_id)
            ->with(['topics' => function ($query) {
                return $query->with(['lessons' => function ($query) {}]);
            }])
            ->paginate(5);


        return view(
            'authenticated.educational-platform.index',
            [
                'CurrentModules' => $CurrentModules,
                'currentLevel' => $currentLevel
            ]
        );
    }
}
