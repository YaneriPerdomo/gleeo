<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $primaryKey = 'topic_id';

    protected $fillable = [
        'topic_id',
        'slug',
        'module_id',
        'title',
        'description'
    ];

    public function lessons(){
         return $this->hasMany(Lesson::class, 'topic_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }


}
