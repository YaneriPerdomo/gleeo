<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $primaryKey = 'progress_id';

    protected $fillable = [
        'player_id',
        'progress_id',
        'level_id',
        'percentage_bar',
        'diamonds',
        'state'
    ];

     public function player(){
        //tabla //llave foranea - hija
        return $this->belongsTo(Player::class, 'player_id');
    }


}
