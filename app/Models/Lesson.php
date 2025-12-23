<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $primaryKey = 'lesson_id';

    protected $fillable = [
        'lesson_id',
        'topic_id',
        'title',
        'slug',
        'is_active'
    ];


    public function topic()
    {
        return $this->hasOne(Topic::class, 'topic_id');
    }
}
