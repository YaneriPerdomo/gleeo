<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';
    protected $primaryKey = 'avatar_id';
    protected $fillable = [
        'avatar_id',
        'name',
        'url',
        'slug'

    ];
}
