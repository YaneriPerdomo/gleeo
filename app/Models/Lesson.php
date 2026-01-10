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
        'guide_id',
        'deleted_at',
        'is_active',
        'order'
    ];



    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
