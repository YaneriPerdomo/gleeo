<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reinforcement extends Model
{
    protected $table = 'reinforcements';

    protected $primaryKey = 'reinforcement_id';

    protected $fillable = [
        'title',
        'paragraph',
        'img',
        'url',
    ];

            public $timestamps = false;

}
