<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    protected $primaryKey = 'module_id';

    protected $fillable = [
        'name',
        'slug',
        'level_id',
        'title',
        'deleted_at'
    ];

    public function topics (){
        return $this->hasMany(Topic::class, 'module_id');
    }

    public function topic  (){
        return $this->hasMany(Topic::class, 'module_id');
    }
     public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
