<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $primaryKey = 'level_id';
    protected $fillable = [
        'name',
        'number',
        'slug',
        'deleted_at',
        'description',
        'order'
    ];

    public function module(){
        return $this->hasMany(Module::class, 'level_id');
    }

     public function moduleOne(){
        return $this->hasOne(Module::class, 'level_id');
    }



    public function progress(){
        //tabla //llave foranea - hija
        return $this->hasOne(Progress::class, 'level_id');
    }
}
