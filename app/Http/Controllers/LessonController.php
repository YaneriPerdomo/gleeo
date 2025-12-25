<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Topic;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        return 'hola';
    }

    public function create($slugLevel, $slugTopic)
    {
        if (!Topic::where('slug', $slugTopic)->exists()) {
            return 'El tema no existe para que pueda agregar una nueva leccion, por favor selccione otro tema por lo cual me despido!!!';
        }



        $moduloTopicInfo = Module::select('module_id',  'title', 'slug')->whereHas('topic', function ($query) use ($slugTopic) {
              $query->select('slug', 'topic_id', 'module_id')->where('slug', $slugTopic);
        })->with(['topic' => function ($query) {
              $query->select('slug', 'topic_id', 'title', 'module_id');
        }])->first();



        return view(
            'authenticated.administrator.study-plan.level.lesson.create',
            [
                'slugLevel' => $slugLevel,
                'slugTopic' => $slugTopic,
                'moduloTopicInfo' => $moduloTopicInfo
            ]
        );
    }

    public function store(Request $request){
        return $request;
    }
}
