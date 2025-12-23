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
        'deleted_at'
    ];

    public function module(){
        return $this->hasMany(Module::class, 'level_id');
    }
}
