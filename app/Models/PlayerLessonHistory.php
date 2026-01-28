<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerLessonHistory extends Model
{
    protected $table = 'players_lessons_history';
    protected $primaryKey = 'player_lesson_history_id';
    protected $fillable = [
        'player_lesson_history_id',
        'player_id',
        'lesson_id',
        'estimated_time',
        'success_rate',
        'reward_diamonds',
        'number_incorrect',
        'number_correct',
        'status',
        'en_uso',
        'completed_at',
    ];

      public function lesson()
    {
        //class - llave foranea - llave primera;
        return $this->belongsTo(Lesson::class, 'lesson_id', 'lesson_id');
    }
}
