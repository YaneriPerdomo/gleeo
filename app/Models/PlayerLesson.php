<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerLesson extends Model
{
    protected $table = 'player_lessons';
    protected $primaryKey = 'player_lesson_id';
    protected $fillable = [
        'player_lesson_id',
        'player_id',
        'lesson_id',
        'duration',
        'diamonds',
        'total_number_correct',
        'total_number_incorrect',
        'state'
    ];

    public function lesson()
    {
        // //tabla //llave foranea - hija
        return $this->hasOne(Lesson::class, 'lesson_id', 'lesson_id');
    }
}
